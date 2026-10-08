USE nexus_portal;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(64) NOT NULL,
  password VARCHAR(128) NOT NULL,
  role VARCHAR(32) NOT NULL DEFAULT 'staff'
);

INSERT INTO users (username, password, role) VALUES
  ('admin', 'admin_secret_2026', 'superuser'),
  ('nova',  'orbit123',          'staff');

CREATE TABLE IF NOT EXISTS app_secrets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  secret_name VARCHAR(128) NOT NULL,
  flag_data   VARCHAR(256) NOT NULL
);

INSERT INTO app_secrets (secret_name, flag_data) VALUES
  ('Master App Flag', 'FLAG{d4t4b4s3_m4st3r_k3y}');