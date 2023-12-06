<?php
// Mulai atau resume sesi
session_start();

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect pengguna kembali ke halaman login
header("Location: ../u_auth/login.php");
exit();
?>