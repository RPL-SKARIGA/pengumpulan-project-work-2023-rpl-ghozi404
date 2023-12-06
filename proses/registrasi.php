<?php
require "koneksi.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Generate ID acak 5 karakter
$id = mt_rand(10000, 99999);

// Hash password sebelum disimpan ke database
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$query_sql = "INSERT INTO user (id, username, email, password) VALUES ('$id', '$username', '$email', '$hashedPassword')";

if (mysqli_query($conn, $query_sql)) {
    header("Location: ../u_auth/login.php");
} else {
    echo "Registrasi gagal. Silakan coba lagi.";
}

?>
