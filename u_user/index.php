<?php
require "../proses/koneksi.php";
include 'header.php';

// Query untuk mengambil data dari tabel hardware
$query = "SELECT id, kategori, nama, spek, deskripsi, harga, img, stok, tgl_tambah, tgl_update
          FROM hardware WHERE tgl_tambah >= CURDATE() - INTERVAL 15 DAY ORDER BY tgl_tambah DESC";

$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCPARTIFY</title>
    <!-- TAILWIND CSS -->
    <script src="../js/tailwind.js"></script>
    <!-- css -->
    <link href="../js/customScrollBar.css" rel="stylesheet">
    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family>Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Mono&display=swap" rel="stylesheet">
    <!-- ICON / LOGO -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- ALAPINE JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.1/dist/cdn.min.js"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }
        #btn {
            filter: drop-shadow(0px 2px 10px rgba(168, 15, 206, 0.453));
        }
        #btn:hover {
            filter: drop-shadow(0px 2px 15px rgb(69, 15, 206));
        }
        .txt {
            filter: drop-shadow(0px 2px 5px rgba(69, 15, 206, 0.437));
        }
        .shadow1 {
            filter: drop-shadow(0px 10px 20px rgba(234, 232, 232, 0.148));
        }
        .shadow2 {
            filter: drop-shadow(3px 2px 5px rgba(6, 6, 6, 0.5));
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
        body {
            background-color: black;
        }
    </style>

    
</head>

<body class="">
    <div id="landing" class="duration-200 bg-[#000] pt-16" :class="{'opacity-20 blur-sm':isClick || isOpen, 'blur-none opacity-100':!(isClick || isOpen)}">

        <div class="bg-[#000]">
            <div class="p-6 lg:flex lg:justify-center">
                <div class="lg:my-12 lg:mx-20">
                    <div class="flex max-lg:justify-center my-4">
                        <!-- LOGO -->
                        <img class="mt-2 w-6 h-6 lg:w-8 lg:h-8" src="../asset/img/hei.png" alt="">
                        <!-- WEB TITLE -->
                        <h1 style="font-family: 'Bebas Neue', sans-serif;" class="font-semibold mt-1 pl-1 text-yellow-50 text-2xl lg:text-4xl px-2 cursor-pointer"><span class="text-yellow-50">PC</span><span class="text-red-500">PART</span>IFY</h1>
                    </div>
                    <div class="lg:w-[75%]">
                        <h1 class="font-[Roboto] max-lg:text-center text-[#f2f2f2] font-extrabold text-4xl underline decoration-gray-500">Build your dream PC</h1>
                        <h1 class="font-[Poppins] max-lg:text-center text-gray-400 font-light max-lg:m-6 lg:my-6">Welcome to <span class="font-semibold text-yellow-200"> PCPARTIFY</span>, a shopping platform that provides various PC components to Prebuilt PC.</h1>
                    </div>
                    <div class="flex flex-col max-lg:items-center max-lg:my-6">
                        <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                            <li class="flex items-center">
                                <svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                More affordable prices
                            </li>
                            <li class="flex items-center">
                                <svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                Unlimited stock
                            </li>
                            <li class="flex items-center">
                                <svg class="w-3.5 h-3.5 me-2 text-gray-500 dark:text-gray-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                Free shipping
                            </li>
                        </ul>
                    </div>
                    <!-- get started -->
                    <div class="flex max-lg:justify-center max-lg:m-4 lg:justify-start lg:my-9">
                        <a href="#main" id="btn" class="duration-200 bg-[#4a2f9d] hover:bg-inherit text-[#f2f2f2] hover:text-[#fdfdfd] py-2 px-9 max-lg:hover:px-12 rounded-full border-[3px] border-[#4a2f9d] shadow1">
                            Get Started
                        </a>
                    </div>
                </div>
                <!-- img -->
                <div class="flex max-lg:justify-center lg:mx-9">
                    <img class="w-[400px] h-[400px]  object-cover shadow1" src="../asset/img/Comp 10.png" alt="">
                </div>
            </div>
        </div>
        <!-- mobile -->
        <div  class="py-9 lg:hidden bg-[#070816] shadow2">
            <h1 class="font-[Roboto] text-[#f2f2f2] font-extrabold text-3xl mb-4 underline decoration-slate-500 text-center txt">New product</h1>
            <h2 class="text-[#f2f2f29a] text-center">
                Latest products added during the last 15 Day
            </h2>
        </div>
        <div id="main" class="flex max-lg:flex-col font-[Poppins] bg-[#0a0c22] max-lg:pl-6 py-6 lg:py-12">
            <!-- desktop -->
            <div id="main" class="hidden lg:block lg:col-span-2 py-9 mx-6 bg-[#070816] rounded-2xl">
                <h1 class="font-[Roboto] text-[#f2f2f2] font-extrabold text-3xl mb-4 underline decoration-slate-500 text-center txt">New Product</h1>
                <h2 class="text-[#f2f2f29a] mx-6 text-center">
                    Latest products added during the last 15 Day
                </h2>
                <!-- button -->
                <div class="hidden lg:block border-t-2 m-6">
                    <div class=" duration-200 bg-[#4a2f9d] hover:bg-[#4a2f9dc9] py-2 w-full mt-9 rounded-lg text-[#fdfdfd] hover:text-gray-300 mx-auto">
                        <a href="product.php" class="flex justify-center gap-1">
                            <i class="fa-solid fa-newspaper text-xl mt-1"></i>
                            <h1 class="text-lg font-semibold">More</h1>
                        </a>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-10 scroll-container border-b-2 bg-[#fdfdfd] border-gray-400 p-6 rounded-l-2xl lg:ml-6 ">
                <div class="flex space-x-6">
                    <?php 
                        while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <div class="duration-300 shadow2 min-w-[240px] group">
                        <div class="p-1 bg-[#f2f2f2] rounded-t-lg">
                            <img class="duration-200 w-full h-44 group-hover:h-40 object-cover rounded-t-lg border-2" src="<?= $row['img'] ?>" alt=""> 
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
            <!-- button -->
            <div class="lg:hidden border-t-2 m-6">
                <div class=" duration-200 bg-[#4a2f9d] hover:bg-[#4a2f9dc9] py-2 px-4 mt-9 rounded-xl text-[#fdfdfd] hover:text-gray-300 w-52 mx-auto">
                    <a href="product.php" class="flex justify-center gap-1">
                        <i class="fa-solid fa-newspaper text-xl mt-1"></i>
                        <h1 class="text-lg font-semibold">More</h1>
                    </a>
                </div>
            </div>
        </div>

    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
    
    
    
</body>
</html>
