<?php
require 'koneksi.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

// Aktifkan error untuk debug (opsional)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Helper function untuk ambil total dari tabel
function getTotal($conn, $table) {
    $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM $table");
    if (!$query) return 0;
    $result = mysqli_fetch_assoc($query);
    return intval($result['total'] ?? 0);
}

// Ambil data statistik
$total_kendaraan = getTotal($conn, 'vehicles');
$total_ritase    = getTotal($conn, 'ritase_logs');
$total_bbm       = getTotal($conn, 'bbm_logs');
$total_user      = getTotal($conn, 'users');

// Buat response JSON
$response = [
    "success" => true,
    "message" => "Dashboard Admin Overview",
    "statistik" => [
        "total_kendaraan" => $total_kendaraan,
        "total_ritase"    => $total_ritase,
        "total_bbm"       => $total_bbm,
        "total_user"      => $total_user
    ],
    "fitur" => [
        "Input Kendaraan",
        "Cek Data Kendaraan",
        "Profile",
        "Settings"
    ]
];

// Output JSON ke Flutter
echo json_encode($response);
