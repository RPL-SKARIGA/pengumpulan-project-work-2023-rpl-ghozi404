<?php
// Sertakan file koneksi.php
include('../proses/koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil ID dari URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Ambil data dari form
        $name = $_POST['name'];
        $spec = $_POST['spec'];
        $desc = $_POST['deskripsi'];
        $stok = $_POST['stok'];
        $price = $_POST['price'];

        // Update data di database
        $query = "UPDATE hardware SET nama = '$name', spek = '$spec', deskripsi = '$desc', stok = '$stok', harga = '$price' WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Handle the image upload
            if (isset($_FILES['gambar'])) {
                $targetDir = "../uploads/";
                $targetFile = $targetDir . basename($_FILES['gambar']['name']);

                // Move the uploaded file to the specified directory
                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile)) {
                    // Update the image path in the database
                    $query = "UPDATE hardware SET img = '$targetFile' WHERE id = $id";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        // Redirect to a success page or do whatever is necessary
                        header("Location: ../u_admin/dashboard.php");
                        exit();
                    } else {
                        echo "Gagal mengupdate gambar produk.";
                    }
                } else {
                    header("Location: ../u_admin/dashboard.php");
                }
            } else {
                echo "Data produk berhasil diupdate, tetapi gambar tidak diubah.";
            }
        } else {
            echo "Gagal mengupdate data produk.";
        }
    } else {
        // Handle if ID is not found in the URL.
        echo "ID tidak ditemukan.";
    }
}
?>
