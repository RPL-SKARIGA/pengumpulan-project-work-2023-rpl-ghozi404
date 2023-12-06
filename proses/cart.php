<?php
    include '../proses/koneksi.php';
    session_start();

    if(!isset($_SESSION['id'])){
        header('Location: ../u_auth/login.php');
        exit;
    }

    $id_user = $_SESSION['id'];
    $id = $_GET['id-product'];
    $qty = 1;

    $result = mysqli_query($conn, "SELECT id_cart, qty FROM cart WHERE id_hardware = '$id' AND id_user = '$id_user'");
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $new_qty = $row['qty'] + $qty;

        $update_query = "UPDATE cart SET qty = '$new_qty' WHERE id_cart = '$row[id_cart]'";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            echo "<script>alert('Berhasil ditambah');
                  window.location.href = '../u_user/index.php';</script>";
        } else {
            echo "<script>alert('Gagal ditambah');</script>";
        }
    } else {
    
        $insert_query = "INSERT INTO cart (id_hardware, id_user, qty) VALUES ('$id', '$id_user', '$qty')";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            echo "<script>
                  window.location.href = '../u_user/index.php';</script>";
        } else {
            echo "<script>alert('Gagal ditambah');</script>";
        }
    }
?>


