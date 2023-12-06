<?php
require "../proses/koneksi.php";
include 'header.php';

// Query untuk mengambil data dari tabel hardware
$query = "SELECT id, kategori, nama, spek, deskripsi, harga, img, stok, tgl_tambah, tgl_update
          FROM hardware 
          WHERE tgl_tambah >= CURDATE() - INTERVAL 60 DAY 
          ORDER BY 
            CASE 
              WHEN kategori = 'Processor' THEN 1
              WHEN kategori = 'Motherboard' THEN 2
              WHEN kategori = 'Vga Card' THEN 3
              WHEN kategori = 'Power Supply' THEN 4
              WHEN kategori = 'Storage' THEN 5
              WHEN kategori = 'Memory' THEN 6
              ELSE 7
            END, tgl_tambah DESC";

$result = mysqli_query($conn, $query);

$cari = "SELECT * FROM hardware";

// menampilkan data yang dicari
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $cari .= " WHERE kategori LIKE '%$keyword%' OR nama LIKE '%$keyword%' OR id LIKE '%$keyword%'";
}

$result = mysqli_query($conn, $cari);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- TAILWIND CSS -->
    <script src="../js/tailwind.js"></script>
    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family>Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Mono&display=swap" rel="stylesheet">
    <!-- ICON / LOGO -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- ALAPINE JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.1/dist/cdn.min.js"></script>
    <link href="../js/customScrollBar.css" rel="stylesheet">
    <style>
        /* .txt {
            filter: drop-shadow(0px 2px 5px rgba(69, 15, 206, 0.437)); 
        }
        .shadow1 {
            filter: drop-shadow(0px 10px 20px rgba(234, 232, 232, 0.148)); 
        }
        .shadow2 {
            filter: drop-shadow(3px 5px 5px rgba(6, 6, 6, 0.350)); 
        } */
        /* Gaya tambahan untuk konten scroll vertical */
        
        #btn:hover {
            filter: drop-shadow(0px 2px 15px rgb(69, 15, 206)); /* Ubah nilai sesuai preferensi Anda */
        }
        html {
            background-color: black;
        }
        .scroll-container {
            overflow-x: auto;
            white-space: nowrap;
            scrollbar-width: none;
            -ms-overflow-style: none;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.8);
        }
        
        .scroll-container::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body>
    <div class="pt-16" :class="{'opacity-20 blur-sm':isClick || isOpen, 'blur-none opacity-100':!(isClick || isOpen)}">
        <div class="p-6 bg-[#2d033b]">
            <form action="product.php" method="GET">
                <div class="flex bg-[#FDFDFD] shadow3 my-4 p-2 rounded-2xl gap-4 mx-[7%]">
                    <!-- search by name -->
                    <div class="flex w-full">
                        <input class="focus:outline-none shadow-inner w-full bg-[#f2f2f2] p-3 rounded-l-2xl border-2" type="text" name="keyword" placeholder="Search by name and Id..." autocomplete="off">
                        <button type="submit" name="cari" class="group duration-200 text-2xl bg-[#2d033b] hover:bg-[#4d265a] text-[#f2f2f2] px-4 rounded-r-2xl flex items-center">
                            <i class="fa-solid fa-magnifying-glass group-hover:animate-pulse"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="lg:col-span-10 scroll-container p-6 rounded-2xl mx-[7%]">
                <div class="flex space-x-6">
                    <?php 
                        while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <div class="duration-300 shadow2 min-w-[240px]">
                        <div class="p-1 bg-[#f2f2f2] rounded-t-lg">
                            <img class="duration-200 w-full h-44  object-cover rounded-t-lg border-2" src="<?= $row['img'] ?>" alt=""> 
                        </div>
                        <div class="font-[Poppins] bg-[#f2f2f2] pt-1 px-2 pb-3 rounded-b-lg">
                            <h1 class="text-sm"><?= $row['nama'] ?></h1>
                            <h2 class="text-sm font-semibold bg-red-400 inline-block mb-1 py-1 px-3 rounded-lg shadow-md">$<?= $row['harga'] ?></h2>
                            <h3 class="text-xs py-2 border-t-2 text-gray-400"><?= $row['tgl_tambah'] ?></h3>
                            <div class="flex gap-2">
                                <h1 class="text-sm text-center pt-[10px] font-bold text-gray-500 bg-yellow-300 px-2 inline-block rounded-lg w-full">#<?= $row['kategori'] ?></h1>
                                <!-- view -->
                                <div class="duration-200 bg-blue-950 border-[3px] border-blue-950 hover:bg-transparent py-2 px-2 rounded-lg text-[#fdfdfd] hover:text-blue-950">
                                    <a href="productView.php?id=<?= $row['id'] ?>" class="flex justify-center gap-1">
                                        <i class="fa-solid fa-eye text-xl"></i>
                                    </a>
                                </div>
                                <!-- cart -->
                                <div class="duration-200 bg-blue-950 border-[3px] border-blue-950 hover:bg-transparent py-2 px-2 rounded-lg text-[#fdfdfd] hover:text-blue-950">
                                    <a href="../proses/cart.php?id-product=<?= $row['id']?>" class="flex justify-center gap-1" onclick="return confirm('Add to Cart?')">
                                    <i class="fa-solid fa-cart-plus text-xl"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    }
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>