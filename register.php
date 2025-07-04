<?php
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_POST['name'] ?? '';
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role     = $_POST['role'] ?? 'user1';

    if (!$name || !$email || !$password) {
        echo json_encode(['success' => false, 'message' => 'Lengkapi semua field.']);
        exit;
    }

    // Enkripsi password
    $hashed = password_hash($password, PASSWORD_BCRYPT);

    // Simpan ke DB
    $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed', '$role')";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true, 'message' => 'Registrasi berhasil.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Email sudah digunakan atau error lainnya.']);
    }
}
?>
