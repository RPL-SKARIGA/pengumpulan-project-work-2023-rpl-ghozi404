<?php
include 'koneksi.php';
session_start();

if (isset($_SESSION['id'])) {
    
   
    $email = $_POST['validateEmail'];
    $address = $_POST['address'];
    $payment = $_POST['payment'];
    $deskripsi = $_POST['deskripsi'];
    $total = $_POST['total_harga'];

    $id_user = $_SESSION['id'];

    // buat checkout record
    $id_check = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);
    $query_checkout = "INSERT INTO checkout (id, id_user, total) VALUES ('$id_check', $id_user, $total)";
    $result_checkout = mysqli_query($conn, $query_checkout);

    // Ambil id_checkout\
    $query_get_checkout_id = "SELECT id FROM checkout";
    $result_get_checkout_id = mysqli_query($conn, $query_get_checkout_id);
    $row = mysqli_fetch_assoc($result_get_checkout_id);
    $id_checkout = $row['id'];

    $query_cart = "SELECT id_hardware, qty FROM cart";
    $result_cart = mysqli_query($conn, $query_cart);

    while ($row = mysqli_fetch_assoc($result_cart)) {
        $id_hardware = $row['id_hardware'];
        $qty = $row['qty'];

        $query_produk = "INSERT INTO checkout_produk (id_checkout, id_product, qty, email, address, payment, deskripsi) VALUES ('$id_checkout', '$id_hardware', '$qty', '$email', '$address', '$payment', '$deskripsi')";
        $result_produk = mysqli_query($conn, $query_produk);
    }

    $query_clear_cart = "DELETE FROM cart";
    $result_clear_cart = mysqli_query($conn, $query_clear_cart);

    header("Location:../u_user/cart.php");
    exit();

}

mysqli_close($conn);
?>
