<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id_cart_to_delete = $_GET["id"];
    $delete_query = "DELETE FROM cart WHERE id_cart = $id_cart_to_delete";
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        // Redirect back to the cart page after successful deletion
        header("Location:../u_user/cart.php");
        exit();
    } else {
        // Handle the error (display an error message, log, etc.)
        echo "Error deleting item from cart: " . mysqli_error($conn);
    }
}
?>
