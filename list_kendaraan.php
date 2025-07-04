<?php
require 'koneksi.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$data = [];
$q = mysqli_query($conn, "SELECT * FROM vehicles ORDER BY id DESC");
while ($row = mysqli_fetch_assoc($q)) {
    $data[] = $row;
}

echo json_encode([
    "success" => true,
    "kendaraan" => $data
]);
