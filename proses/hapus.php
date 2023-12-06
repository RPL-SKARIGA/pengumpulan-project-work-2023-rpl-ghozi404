<?php

include 'koneksi.php';

// Periksa koneksi database
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Periksa apakah ID yang akan dihapus sudah diberikan
if (isset($_GET['id'])) {
    // Ambil ID dari parameter URL
    $id = $_GET['id'];

    // Query SQL untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM hardware WHERE id = $id";

    // Eksekusi query
    if (mysqli_query($conn, $sql)) {
        header("Location: ../u_admin/adminHardware.php");
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
} else {
    echo "ID tidak diberikan.";
}

// Tutup koneksi database
mysqli_close($conn);
?>
