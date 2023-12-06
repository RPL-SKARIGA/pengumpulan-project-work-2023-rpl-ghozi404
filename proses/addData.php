<?php
include 'koneksi.php';

function RandID() {
    return rand(10000, 99999);
}

$kategori = $_POST['selectedCategory'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

$id = RandID();

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["gambar"]["name"]);

if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
    echo "Gambar " . htmlspecialchars(basename($_FILES["gambar"]["name"])) . " berhasil diupload.";
} else {
    echo "Maaf, terjadi kesalahan saat mengupload gambar.". print_r($_FILES, true);;
    exit();
}

if ($kategori === "Processor") {
    $brand = $_POST['Brand'];
    $segment = $_POST['Segment'];
    $cpuGen = $_POST['cpu-gen'];
    $frequency = $_POST['freq'];
    $core = $_POST['core'];
    $threads = $_POST['threads'];
    $tdp = $_POST['tdp'];
    $deskripsi = $_POST['deskripsi'];

    $nama = $brand . " " . $segment . " " . $cpuGen;

    $sql = "INSERT INTO hardware (id, kategori, nama, spek, img, deskripsi, stok, harga)
    VALUES ('$id', '$kategori', '$nama', 'Frequency: $frequency GHz, Core: $core, Threads: $threads, TDP: $tdp Watt', '$target_file', '$deskripsi', '$stok', '$harga')";

} elseif ($kategori === "Motherboard") {
    $nama = $_POST['nama'];
    $socket = $_POST['socket'];
    $max_memory = $_POST['max-memory'];
    $memory_slot = $_POST['memory-slot'];
    $deskripsi = $_POST['deskripsi2'];

    $spek = "Socket: $socket, Maximum Memory: $max_memory GB, Memory Slot: $memory_slot";

    $sql = "INSERT INTO hardware (id, kategori, nama, spek, img, deskripsi, stok, harga)
    VALUES ('$id', '$kategori', '$nama', '$spek', '$target_file', '$deskripsi', '$stok', '$harga')";

} elseif ($kategori === "VGA Card"){
    $nama = $_POST['chipset'];
    $spek = $_POST['spek'];
    $deskripsi = $_POST['deskripsi3'];

    $sql = "INSERT INTO hardware (id, kategori, nama, spek, img, deskripsi, stok, harga)
    VALUES ('$id', '$kategori', '$nama', '$spek', '$target_file', '$deskripsi', '$stok', '$harga')";

} elseif ($kategori === "Power Supply"){
    $nama = $_POST['psuName'];
    $rating = $_POST['rating'];
    $wattage = $_POST['wattage'];
    $deskripsi = $_POST['deskripsi4'];

    $spek = "Efficiency Rating: $rating, Wattage: $wattage Watt";

    $sql = "INSERT INTO hardware (id, kategori, nama, spek, img, deskripsi, stok, harga)
    VALUES ('$id', '$kategori', '$nama', '$spek', '$target_file', '$deskripsi', '$stok', '$harga')";

} elseif ($kategori === "Storage"){
    $nama = $_POST['romName'];
    $type = $_POST['romType'];
    $capacity = $_POST['capacity'];
    $deskripsi = $_POST['deskripsi5'];
    
    if ($capacity >= 1000) {
        $capacity = $capacity / 1000;
        $spek = "Type: $type, Capacity: $capacity TB";
    } else {
        $spek = "Type: $type, Capacity: $capacity GB";
    }

    $sql = "INSERT INTO hardware (id, kategori, nama, spek, img, deskripsi, stok, harga)
    VALUES ('$id', '$kategori', '$nama', '$spek', '$target_file', '$deskripsi', '$stok', '$harga')";

} elseif ($kategori === "Memory"){
    $nama = $_POST['ramName'];
    $type = $_POST['ramType'];
    $speed = $_POST['speed'];
    $size = $_POST['size'];
    $deskripsi = $_POST['deskripsi6'];
    
    $spek = "Type: $type, Speed: $speed MHz , Size: $size Gb";

    $sql = "INSERT INTO hardware (id, kategori, nama, spek, img, deskripsi, stok, harga)
    VALUES ('$id', '$kategori', '$nama', '$spek', '$target_file', '$deskripsi', '$stok', '$harga')";
}

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil ditambahkan.";
    
    header("Location: ../u_admin/dashboard.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
