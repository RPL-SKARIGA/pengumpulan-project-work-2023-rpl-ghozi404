<?php
require "koneksi.php";
session_start(); // Memulai sesi

$username = $_POST['username'];
$name = $_POST['username'];
$password = $_POST['password'];

$query_sql_user = "SELECT * FROM user WHERE username = '$username'";
$result_user = mysqli_query($conn, $query_sql_user);

$query_sql_admin = "SELECT * FROM admin WHERE name = '$name'";
$result_admin = mysqli_query($conn, $query_sql_admin);

if (mysqli_num_rows($result_user) > 0) {
    $row = mysqli_fetch_assoc($result_user);
    $hashedPassword = $row['password'];
    $id = $row['id'];

    if (password_verify($password, $hashedPassword)) {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id;
        header("Location: ../u_user/index.php");
        exit;

    } else {
        echo "Login <p style='color: red;'>gagal</p>. Kata sandi salah untuk pengguna.";
    }

} elseif (mysqli_num_rows($result_admin) > 0) {
    $row_admin = mysqli_fetch_assoc($result_admin);
    $adminPassword = $row_admin['password'];

    if ($password === $adminPassword) {
        $_SESSION['name'] = $name;
        header("Location: ../u_admin/dashboard.php");
        exit;
        
    } else {
        echo "Login <p style='color: red;'>gagal</p>. Kata sandi salah untuk admin.";
    }
} else {
    echo "Login <p style='color: red;'>gagal</p>. Pengguna tidak ditemukan.";
}
?>
