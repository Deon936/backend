<?php 
require 'koneksi.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

// Ambil domain/URL dasar dari server
$baseUrl = (
    (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http"
) . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/';

// Informasi sistem API
$response = [
    "status" => "sukses",
    "message" => "Pemantauan API Potong & Isi aktif",
    "versi" => "1.0.0",
    "titik_akhir" => [
        "POST {$baseUrl}login.php" => "Masuk pengguna",
        "POST {$baseUrl}register.php" => "Daftarkan pengguna baru",
        "POST {$baseUrl}input_ritase.php" => "Masukkan ritase harian",
        "POST {$baseUrl}bbm.php" => "Masukkan konsumsi BBM setiap hari",
        "GET  {$baseUrl}get_kendaraan.php" => "Ambil data kendaraan",
        "GET  {$baseUrl}get_users.php" => "Ambil data pengguna",
        "POST {$baseUrl}delete_user.php" => "Hapus pengguna",
        "POST {$baseUrl}input_kendaraan.php" => "Tambah kendaraan",
        "POST {$baseUrl}delete_kendaraan.php" => "Hapus kendaraan",
        "GET  {$baseUrl}admin_dashboar.php" => "Statistik admin dashboard",
        "GET  {$baseUrl}direktur_dashboard.php" => "Statistik direktur dashboard"
    ]
];

echo json_encode($response, JSON_PRETTY_PRINT);
