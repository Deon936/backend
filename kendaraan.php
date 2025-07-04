<?php
require 'koneksi.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// Log isi $_POST
$log = [
    'operator_name' => $_POST['operator_name'] ?? null,
    'vehicle_type' => $_POST['vehicle_type'] ?? null,
    'plate_number' => $_POST['plate_number'] ?? null,
    'bucket_volume' => $_POST['bucket_volume'] ?? null,
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($log['operator_name'] && $log['vehicle_type'] && $log['plate_number'] && $log['bucket_volume']) {
        $stmt = mysqli_prepare($conn, "INSERT INTO vehicles (operator_name, vehicle_type, plate_number, bucket_capacity, created_at) VALUES (?, ?, ?, ?, NOW())");
        mysqli_stmt_bind_param($stmt, "sssd", $log['operator_name'], $log['vehicle_type'], $log['plate_number'], $log['bucket_volume']);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($success) {
            echo json_encode(["success" => true, "message" => "Kendaraan berhasil disimpan."]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal menyimpan ke database."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Data tidak lengkap.", "debug_post" => $log]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Method tidak diizinkan."]);
}
