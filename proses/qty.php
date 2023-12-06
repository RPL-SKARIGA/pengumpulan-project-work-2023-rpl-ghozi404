<?php
include 'koneksi.php';

if (isset($_GET['id_cart']) && is_numeric($_GET['id_cart']) && isset($_GET['action'])) {
    $id_cart = $_GET['id_cart'];
    $action = $_GET['action'];

    $query = "SELECT qty FROM cart WHERE id_cart = $id_cart";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $qty = $row['qty'];

        if ($action == 'plus') {
            $jumlah_baru = $qty + 1;
        } elseif ($action == 'minus') {
            $jumlah_baru = max(1, $qty - 1);
        }
        $update_query = "UPDATE cart SET qty = $jumlah_baru WHERE id_cart = $id_cart";
        $update_result = mysqli_query($conn, $update_query);
        if (!$update_result) {
            die("Error updating record: " . mysqli_error($conn));
        }
    } else {
        die("Error fetching record: " . mysqli_error($conn));
    }

    mysqli_close($conn);
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}
?>
