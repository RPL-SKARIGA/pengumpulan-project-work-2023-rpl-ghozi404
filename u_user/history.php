<?php
require "../proses/koneksi.php";
include 'header.php';

$query = "SELECT * FROM checkout
          JOIN checkout_produk ON checkout.id = checkout_produk.id_checkout
          ORDER BY checkout.tanggal DESC";

$result = mysqli_query($conn, $query);


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
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
    <div class="p-24">
        
    <?php
        while ($row = mysqli_fetch_assoc($result) ) {
        ?>
            <div class="flex gap-6 my-4 bg-gray-300 p-9 border-2 border-dashed border-gray-400 rounded-lg ">
                <div class="w-1/2">
                    <div class="text-[#2d033b] font-semibold text-xs">
                        <h1>Checkout ID</h1>
                        <h1 class="text-xl leading-tight"><?= $row['id_checkout'] ?></h1>
                    </div>
                    <div class="text-[#2d033b] font-semibold text-xs my-2">
                        <h1>user ID</h1>
                        <h1 class="text-xl leading-tight"><?= $row['id_user'] ?></h1>
                    </div>
                    <div class="flex gap-9 text-[#2d033b] font-semibold text-xs my-2">
                        <h1 class="text-xl leading-tight">id hardware: <?= $row['id_product'] ?></h1>
                        <h1 class="text-xl leading-tight">qty: <?= $row['qty'] ?></h1>
                    </div>
                    <div class="text-[#2d033b] font-semibold text-xs my-2">
                        <h1>Total Price</h1>
                        <h1 class="text-xl leading-tight">$<?= $row['total'] ?></h1>
                    </div>
                    <div class="text-[#2d033b] font-semibold text-xs my-2">
                        <h1>Payment</h1>
                        <h1 class="text-xl leading-tight italic font-extrabold"><?= $row['payment'] ?></h1>
                    </div>
                </div>
                <div class="border-l-2 border-black px-6">
                    <div class="text-[#2d033b] font-semibold text-xs">
                        <h1>Email</h1>
                        <h1 class="text-xl leading-tight"><?= $row['email'] ?></h1>
                    </div>
                    <div class="text-[#2d033b] font-semibold text-xs my-2">
                        <h1>Address</h1>
                        <h1 class="text-xl leading-tight"><?= $row['address'] ?></h1>
                    </div>
                    <div class="text-[#2d033b] font-semibold text-xs my-2">
                        <h1>Description</h1>
                        <h1 class="text-xl leading-tight"><?= $row['deskripsi'] ?></h1>
                    </div>
                </div>
                <div class="flex justify-end w-full">
                    <div class="text-[#2d033b] font-semibold text-xs my-2">
                        <h1>Date</h1>
                        <h1 class="text-xl leading-tight"><?= $row['tanggal'] ?></h1>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>