<?php
require_once 'koneksi.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

// Ambil input dari Flutter
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Data dummy pengguna
$dummy_users = [
    'direktur@example.com' => ['id' => 1, 'name' => 'Direktur Utama', 'role' => 'direktur'],
    'admin@example.com'    => ['id' => 2, 'name' => 'Admin Proyek', 'role' => 'admin'],
    'user1@example.com'    => ['id' => 3, 'name' => 'Pelaksana Lapangan', 'role' => 'user1'],
    'user2@example.com'    => ['id' => 4, 'name' => 'Logistik BBM', 'role' => 'user2'],
];

// Cek login
if (isset($dummy_users[$email])) {
    $user = $dummy_users[$email];

    // Dalam dummy ini, password diabaikan
    echo json_encode([
        "success" => true,
        "message" => "Login berhasil",
        "data" => $user
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Email tidak ditemukan"
    ]);
}
