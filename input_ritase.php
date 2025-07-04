<?php
require 'koneksi.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$data = json_decode(file_get_contents("php://input"), true);

$user_id = intval($data['user_id'] ?? 0);
$vehicle_id = intval($data['vehicle_id'] ?? 0);
$rit_count = intval($data['rit_count'] ?? 0);
$weather = mysqli_real_escape_string($conn, $data['weather_condition'] ?? '');
$bucket_volume = floatval($data['bucket_volume'] ?? 0);
$date = date('Y-m-d');

if ($user_id && $vehicle_id && $rit_count) {
    $q = "INSERT INTO ritase_logs (user_id, vehicle_id, date, rit_count, weather_condition, bucket_volume)
          VALUES ($user_id, $vehicle_id, '$date', $rit_count, '$weather', $bucket_volume)";
    $exec = mysqli_query($conn, $q);
    
    echo json_encode([
        "success" => $exec,
        "message" => $exec ? "Ritase berhasil dicatat" : "Gagal input ritase"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Data tidak lengkap"
    ]);
}
