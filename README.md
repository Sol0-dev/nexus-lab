# Nexus Office Portal - Training Lab

A lightweight Docker lab for learning how to find the most common web
application vulnerabilities. It is a modern-looking mock corporate portal with
a small sidebar menu. Several vulnerable tools are NOT in the menu, exactly
like hidden functionality in real applications. You discover them by doing
proper reconnaissance.

This lab teaches the same discovery concepts as a standard web penetration
practice range: recon first, then authentication, access control, file
handling, uploads, server-side requests, command execution and chaining. Every
finding hides a flag in the format `FLAG{...}`.

## Stack

- Web: PHP 8.2 on Apache (Nexus Office Portal)
- Database: MySQL 8, internal only (Nexus Portal DB)
- Internal microservice: Python, reachable only from the web container

## Quick start

```bash
cd labs/nexus-portal
docker compose up -d --build
```

Open http://localhost:8080

Teardown and full reset:

```bash
docker compose down -v
```

## What you will learn

1. Recon and enumeration: map the surface before touching any form.
2. Authentication bypass in a SQL-backed login.
3. Object-level access control on a resource identifier.
4. Client-side trust: a role decided by a cookie.
5. File path handling: reading arbitrary local files.
6. Unrestricted file upload that becomes code execution.
7. Server-side request forgery into an internal service.
8. Command injection in a diagnostic tool.
9. Reflected output without encoding.
10. Chaining leaked credentials to the internal database.

## How to use the guide

The application itself contains no hints or walkthrough text, so it behaves
like a real target. For concept-level guidance without full answers, read
HINTS.md before you start. When you are done, compare your notes against the
reference walkthrough in GUIDE.md. The attack path is the same on purpose: the
flags and the application are different, the methodology is not.

## Flag inventory

| # | Weakness | Where it hides | Flag |
|---|----------|----------------|------|
| 1 | Path traversal / LFI | document viewer page parameter | FLAG{tr4v3rs3_7h3_p4th} |
| 2 | Command injection | diagnostics target field | FLAG{sh3ll_1nj3c710n_rce} |
| 3 | SQL injection auth bypass | staff login | FLAG{un10n_byp4ss_l0g1n} |
| 4 | IDOR | invoice identifier | FLAG{0bj3c7_l3v3l_4uth} |
| 5 | Cookie privilege escalation | profile role cookie | FLAG{c00k13_f0rg3ry_4dm1n} |
| 6 | Unrestricted file upload | avatar upload | FLAG{up10ad_4nd_3x3c} |
| 7 | SSRF | webhook tester | FLAG{5srf_1n73rn4l_p1v0t} |
| 8 | Backup file leak | backup config | FLAG{b4ckup_l34k5_cr3d5} |
| 9 | Sensitive data in robots.txt | robots.txt | FLAG{r0b075_1n_75} |
| 10 | Reflected XSS | invoice identifier echo | none (teaching only) |
| 11 | Database master flag (chain) | internal database | FLAG{d4t4b4s3_m4st3r_k3y} |

Good luck, and happy hunting.