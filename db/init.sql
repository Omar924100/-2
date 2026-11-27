-- SentinelSOC — base de demonstration
CREATE DATABASE IF NOT EXISTS sentinel_soc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sentinel_soc;

CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(64) UNIQUE NOT NULL,
  password_hash VARCHAR(64) NOT NULL,
  role VARCHAR(32) NOT NULL
);

CREATE TABLE logs (
  id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(200) NOT NULL,
  body TEXT,
  severity VARCHAR(16),
  created_at VARCHAR(32)
);

INSERT INTO users (username, password_hash, role) VALUES
('admin',   MD5('sentinel2024'), 'admin'),
('analyst', MD5('analyst123'),   'analyst'),
('soc2',    MD5('soc2#Pass2025'),'analyst');

INSERT INTO logs (id, title, body, severity, created_at) VALUES
(1, 'Scan de port detecte', 'Balayage SYN depuis 203.0.113.44 sur le segment DMZ.', 'MOYEN', '2026-10-02 03:12'),
(2, 'Tentative de brute force SSH', '12 echecs sur bastion-01, source 198.51.100.9.', 'MOYEN', '2026-10-05 11:40'),
(3, 'Alerte antivirus — poste RH-14', 'Cle USB non autorisee inseree, scan negatif.', 'FAIBLE', '2026-10-11 09:05'),
(4, 'Filtrage web — categorie jeu', 'Trafic bloqué depuis le reseau visiteurs.', 'INFO', '2026-10-14 14:22'),
(5, 'Certificat expire — intranet legacy', 'Le certificat du portail legacy expire dans 7 jours.', 'MOYEN', '2026-10-20 08:00'),
(6, 'Connexion admin hors heures', 'Session admin ouverte un samedi a 3h depuis le VPN.', 'ELEVE', '2026-10-25 03:03'),
(7, 'Sonde IDS redemarree', 'Redemarrage planifie de la sonde DMZ-2.', 'INFO', '2026-11-02 22:00');
