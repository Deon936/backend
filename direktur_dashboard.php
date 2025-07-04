<?php
require 'koneksi.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

// Statistik
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$total_kendaraan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM vehicles"))['total'];
$total_ritase = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM ritase_logs"))['total'];
$total_bbm = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM bbm_logs"))['total'];

// History kegiatan (10 terakhir)
$history = [];

$q = mysqli_query($conn, "
  (SELECT 'Input Ritase' as aksi, users.name, ritase_logs.date 
   FROM ritase_logs 
   JOIN users ON ritase_logs.user_id = users.id)
  UNION
  (SELECT 'Input BBM' as aksi, users.name, bbm_logs.date 
   FROM bbm_logs 
   JOIN users ON bbm_logs.user_id = users.id)
  ORDER BY date DESC LIMIT 10
");

while ($row = mysqli_fetch_assoc($q)) {
    $history[] = $row;
}

echo json_encode([
  "success" => true,
  "message" => "Dashboard Direktur",
  "statistik" => [
    "total_users" => $total_users,
    "total_kendaraan" => $total_kendaraan,
    "total_ritase" => $total_ritase,
    "total_bbm" => $total_bbm
  ],
  "riwayat" => $history
]);
