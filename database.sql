-- database.sql
-- Import file ini di phpMyAdmin (atau `mysql -u root -p < database.sql`)

CREATE DATABASE IF NOT EXISTS sipustaka CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE sipustaka;

CREATE TABLE IF NOT EXISTS buku (
  id INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(255) NOT NULL,
  penulis VARCHAR(255) NOT NULL,
  penerbit VARCHAR(255) DEFAULT NULL,
  tahun INT DEFAULT NULL,
  kategori VARCHAR(100) DEFAULT NULL,
  status ENUM('Tersedia', 'Tidak Tersedia') NOT NULL DEFAULT 'Tersedia',
  cover VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Data contoh (opsional, boleh dihapus)
INSERT INTO buku (judul, penulis, penerbit, tahun, kategori, status, cover) VALUES
('Fisika Modern', 'Dr. Ahmad Fauzi', 'Penerbit Erlangga', 2023, 'Sains', 'Tersedia', NULL),
('Pengantar Biologi Molekuler', 'Dr. Syahran Wael', 'Gramedia', 2022, 'Biologi', 'Tersedia', NULL),
('Kalkulus Elementer', 'Prof. Rahmawati', 'Penerbit ITB', 2021, 'Matematika', 'Tidak Tersedia', NULL),
('Algoritma dan Struktur Data', 'Ir. Budi Santoso', 'Informatika Bandung', 2023, 'Informatika', 'Tersedia', NULL),
('Kimia Dasar', 'Dr. Lestari', 'Erlangga', 2020, 'Kimia', 'Tersedia', NULL);
