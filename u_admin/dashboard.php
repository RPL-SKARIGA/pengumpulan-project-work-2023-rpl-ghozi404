<?php
require "../proses/koneksi.php";
session_start();

// Periksa apakah pengguna sudah masuk atau tidak
if (!isset($_SESSION['name'])) {
    // Jika pengguna belum masuk, Anda dapat mengarahkannya ke halaman login atau melakukan tindakan lain sesuai kebijakan keamanan Anda.
    // Contohnya:
    header("Location: ../u_auth/login.php");
    exit();
}

// Ambil $username dari sesi
$name = $_SESSION['name'];

// Query untuk mengambil data admin berdasarkan username
$query = "SELECT name FROM admin WHERE name = '$name'";
$result = mysqli_query($conn, $query);


// Periksa apakah data admin ditemukan
if ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
}

// Query untuk mengambil data dari tabel hardware
$query = "SELECT id, kategori, nama, spek, deskripsi, harga, img, stok, tgl_tambah, tgl_update
          FROM hardware WHERE tgl_tambah >= CURDATE() - INTERVAL 7 DAY ORDER BY tgl_tambah DESC";

$result = mysqli_query($conn, $query);

// ngitung jumlah data
$query = "SELECT COUNT(*) as jumlah_data FROM hardware";
$count = mysqli_query($conn,$query);

if ($count->num_rows > 0) {
    $row = $count->fetch_assoc();
    $jumlah_data = $row['jumlah_data'];
} else {
    $jumlah_data = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" href="../asset/img/hei.png" type="image/png">
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
        .shadow1 {
            /* Horizontal offset, vertical offset, blur radius, spread radius, color */
            box-shadow: 5px 10px 10px 0px rgba(0, 0, 0, 0.193);
            }
        .shadow2 {
            filter: drop-shadow(3px 2px 5px rgba(6, 6, 6, 0.5)); /* Ubah nilai sesuai preferensi Anda */
        }
        .scroll-container {
            position: relative;
            overflow-x: auto; /* Mengganti overflow-x menjadi overflow-y */
            max-height: 400px; /* Atur tinggi maksimum sesuai kebutuhan */
            scrollbar-width: none;
            -ms-overflow-style: none;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .scroll-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
        }

        .scroll-container::-webkit-scrollbar {
            width: 5px;
        }
        
            
    </style>
</head>

<body class="bg-[#FDFDFD] font-[Poppins]" >

    <!-- peringatan jika resolusi tidak sesuai -->
    <div class="fixed z-50 top-[300px] w-full p-6 bg-[#f2f2f2] border-y-[0.5px] border-black xl:hidden">
        <h1 class="font-extrabold text-center">
            <span class="text-4xl text-left">
                <i class="fa-solid fa-triangle-exclamation text-yellow-600"></i>
            </span><br>
            <span>
                <span class="bg-zinc-950 text-[#f2f2f2] pl-2">PC</span><span class="bg-zinc-950 text-red-400">PART</span><span class="bg-zinc-950 text-[#f2f2f2] pr-2">IFY</span> 
                <span class="text-[#0000005a]">// Admin Page Say</span><span> :</span>
                <span class="text-blue-700">Sorry</span>, to open the admin page you need a larger resolution, 
                <span class="text-red-700">your resolution is not supported</span> :(</span>
        </h1>
    </div>

    <div 
        x-data="{buka : true}" 
        class="grid grid-cols-12 grid-flow-col  max-xl:blur-2xl" >

        <!-- SIDEBAR -->
        <div id="sidebar" 
            class="fixed z-30 duration-100 row-span-3 col-span-2 left-0 top-0 h-full bg-[#2d033b] p-4" 
            :class="{'w-64 ease-in':buka === true, 'w-16 ease-out': buka === false}">
        
            <a href="#" class="flex items-center pb-3 border-b-2 border-b-gray-500">
                <!-- icon web -->
                <img src="../asset/img/hei.png" class="relative w-7 h-7" x-bind:class="{'left-0':buka, 'left-0.5':!buka}">
                <!-- nama web -->
                <h1 style="font-family: 'Bebas Neue', sans-serif;" class="duration-100 font-semibold pl-1 text-yellow-50 text-3xl px-2 cursor-pointer" :class="{'block':buka, 'hidden':!buka}"><span class="text-yellow-50">PC</span><span class="text-red-500">PART</span>IFY</h1>
            </a>
    
            <ul class="mt-4">
    
                <li class="my-4 shadow2">
                    <a href="dashboard.php" class="flex gap-2 text-[#f2f2f2] hover:text-gray-400"
                        :class="{'items-center py-2 px-4 hover:bg-[#807e7e72] rounded-r-xl bg-[#370e44] border-l-4 border-[#810ca8]':buka === true, 'py-2 px-1.5 border-b-[3px] border-[#810ca8] hover:border-[#810ca889]': buka === false}">

                        <i class="fa-solid fa-list text-lg duration-100" ></i>
                        <span class="text-sm":class="{'block':buka, 'hidden':!buka}">Dashboard</span>  
                    </a>
                </li>
                <li class="mb-1">
                    <a href="adminHardware.php" class="flex gap-2 text-[#f2f2f2] hover:text-gray-400"
                        :class="{'items-center py-2 px-4 hover:bg-[#807e7e72] rounded-xl':buka === true, 'py-2 px-1.5': buka === false}"
                        >

                        <i class="fa-solid fa-microchip text-lg duration-100" ></i>
                        
                        <span class="text-sm":class="{'block':buka, 'hidden':!buka}">Hardware</span>
                        
                    </a>
                </li>

                <li class="mb-1">
                    <a href="#" class="flex gap-2 text-[#f2f2f2] hover:text-gray-400"
                        :class="{'items-center py-2 px-4 hover:bg-[#807e7e72] rounded-xl':buka === true, 'py-2 px-1.5': buka === false}">
                        
                        <i class="fa-solid fa-address-book text-lg duration-100" ></i>
                        <span class="text-sm" :class="{'block':buka, 'hidden':!buka}">Activity</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- NAVBAR -->
        <div class="duration-100 bg-white fixed top-0 col-span-11 w-full p-4 shadow-md z-10" x-bind:class="{'left-64 ':buka, 'left-16 ':!buka}">
            <ul class="flex gap-4">
                <li>
                    <a href="#" @click="buka = !buka">
                        <i class="fa-solid fa-bars text-xl text-[#424242]"></i>
                    </a> 
                </li>
                <li>
                    <span class="text-lg font-semibold text-[#00000051]">Admin Dashboard</span>
                </li>

                <li class="duration-50" x-bind:class="{ 'ml-[830px]': buka, 'ml-[1020px]' : !buka }" x-data="{ open: false }">
                    <a href="#" class="" @click="open = !open">
                        <div class="duration-300 flex gap-2 bg-[#810ca8] hover:bg-[#810ca8ac] py-1 px-3 " x-bind:class="{ 'rounded-t-lg': open, 'rounded-lg': !open }">
                            
                            <h1 class="text-[#f2f2f2]">Login as <span class="text-yellow-400 font-semibold mx-1"><?= $name ?></span></h1>

                            <i class="pr-1 text-[#fdfdfd] duration-100 fa-solid fa-chevron-right mx-1 mt-1" x-bind:class="{ 'rotate-90': open, 'rotate-0': !open }"></i>
                        </div>
                    </a>

                    <ul class="absolute bg-[#f2f2f2] w-[183px] border-x-2 border-b-2 border-transparent rounded-b-lg px-3 py-2 shadow1"
                    x-show="open"
                    x-transition:enter="transition-opacity ease-in duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity ease-out duration-100"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click.away="open = false">
                        
                        <li>
                            <a href="../proses/logoutAdmin.php" class="font-semibold text-gray-600 hover:text-[#42424257]">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        
        
        <!-- KONTEN WEB -->
        <div class="relative col-span-10 left-64 top-16 m-4 " x-bind:class="{'translate-x-0':buka, 'translate-x-20 left-16':!buka}">
            
             <!-- MENU INCOME, COMMENT, DAN TOTAL PRODUK -->
            <!-- <div class="grid grid-cols-12 gap-0.5 mb-1">
                <div class="group col-span-4 bg-[#2d033b] hover:bg-[#5a1571] rounded-l-2xl">
                    
                    <a href="#">
                        <ul class="flex py-3 px-6 items-center gap-3">
                            <li class="">
                                <i class="fa-solid fa-money-bills text-[30px] text-[#f2f2f2]"></i>
                            </li>
                            <li class="flex">
                                <h1 class="px-3 text-[#f2f2f2] text-xl tracking-tighter">Penghasilan :</h1>
                                <span class="font-[Roboto] text-[20px] font-extrabold text-[#f2f2f2] tracking-wider">$7000</span> 
                            </li>
                        </ul>
                    </a>
                    
                </div>
                <div class="group col-span-2 bg-[#2d033b] hover:bg-[#5a1571]">
                    <a href="#">
                        <ul class="flex py-3 items-center justify-center gap-3">
                            <li class="">
                                <i class="fa-solid fa-address-card text-[30px] text-[#f2f2f2]"></i>
                            </li>
                            <li class="flex">
                                <h1 class="text-[#f2f2f2] text-md">Aktifitas Login</h1>
                            </li>
                        </ul>
                    </a>
                </div>
                <div class="group col-span-3 bg-[#2d033b] hover:bg-[#5a1571]">
                    <a href="#">
                        <ul class="flex py-3 items-center justify-center gap-3">
                            <li class="">
                                <i class="fa-solid fa-message text-[30px] text-[#f2f2f2]"></i>
                            </li>
                            <li class="flex gap-2">
                                <h1 class="text-[#f2f2f2] text-lg">Ulasan :</h1>
                                <h1 class="font-[Roboto] font-bold text-2xl text-[#f2f2f2]">80</h1>
                            </li>
                        </ul>
                    </a>
                </div>
                <div class="group col-span-3 bg-[#2d033b] hover:bg-[#5a1571] rounded-r-2xl">
                    <a href="adminHardware.php">
                        <ul class="flex py-3 items-center justify-center gap-3">
                            <li class="">
                                <i class="fa-solid fa-box-open text-[30px] text-[#f2f2f2]"></i>
                            </li>
                            <li class="flex gap-2">
                                <h1 class="text-[#f2f2f2] mt-0.5 text-lg">Total Produk :</h1>
                                <h1 class="font-[Roboto] font-bold text-2xl text-[#f2f2f2]"><?= $jumlah_data ?></h1>
                            </li>
                        </ul>
                    </a>
                </div>
            </div> -->

            <!-- MENU PESANAN -->
            <!-- <div class="my-6 grid grid-cols-12 gap-3">
                <div class="col-span-12">
                    <span class="text-xl font-bold">Pesanan</span>
                </div>

                <div class="group duration-300 col-span-4 bg-[#f2f2f2] border-2 rounded-xl shadow1 hover:shadow-lg p-4">
                    <a href="#" class="flex group-hover:text-[#0000005e]">
                        <div class="w-[600px]">
                            <h1 class="text-5xl font-[Roboto] font-extrabold">21</h1>
                            <h2>Menunggu pengiriman</h2>
                        </div>
                        <div>
                            <i class="fa-regular fa-clock text-[75px]"></i>
                        </div>
                    </a>
                </div>
                <div class="group duration-300 col-span-4 bg-[#f2f2f2] border-2 rounded-xl shadow1 hover:shadow-lg p-4">
                    <a href="#" class="flex group-hover:text-[#0000005e]">
                        <div class="w-[600px]">
                            <h1 class="text-5xl font-[Roboto] font-extrabold">21</h1>
                            <h2>Pesanan Terkirim</h2>
                        </div>
                        <div>
                            <i class="fa-regular fa-calendar-check text-[75px]"></i>
                        </div>
                    </a>
                </div>
                <div class="group duration-300 col-span-4 bg-[#f2f2f2] border-2 rounded-xl shadow1 hover:shadow-lg p-4">
                    <a href="#" class="flex group-hover:text-[#0000005e]">
                        <div class="w-[600px]">
                            <h1 class="text-5xl font-[Roboto] font-extrabold">21</h1>
                            <h2>Pesanan Dibatalkan</h2>
                        </div>
                        <div>
                            <i class="fa-regular fa-calendar-xmark text-[75px]"></i>
                        </div>
                    </a>
                </div>  
            </div>  -->
            
            <!-- Tabel produk -->
            <div id="tabelProduk" class="mb-4">
                <h1 class="font-semibold text-xl py-3">Terakhir kali ditambahkan</h1>

                <div class=" p-6 bg-[#f2f2f2] rounded-xl border-2 shadow-lg">
                    
                    <div class="flex max-2xl:justify-center">
                        <div class="scroll-container p-6 rounded-lg">
                            <div class="flex space-x-8">
                                <?php 
                                    while($row = mysqli_fetch_assoc($result)){
                                       $nama = $row['nama'];

                                       if (strlen($nama) > 18) {
                                            $nama = substr($nama, 0, 18) . "...";
                                        }
                                ?>
                                <div class="flex flex-col shadow2">
                                    <img src="<?= $row['img'] ?>" class="max-w-[200px] max-h-[200px] rounded-t-xl bg-white" />
                                    <div class="bg-gray-300 p-4 border-t-4 border-[#2d033b] rounded-b-xl">
                                        <h1 class="font-semibold text-[#2d033b] text-sm"><?= $nama ?></h1>
                                        <h1 class="font-semibold text-gray-600 text-xs"><?= $row['tgl_tambah'] ?></h1>
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
            </div>
            
        </div>
        
    </div>
    
    <script>
        // Membuat event listener untuk tombol edit
        const editButtons = document.querySelectorAll('.btnEdit');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                window.location.href = `edit.php?id=${id}`;
            });
        });

        // Membuat event listener untuk tombol delete
        const deleteButtons = document.querySelectorAll('.btnHapus');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                window.location.href = `../proses/hapus.php?id=${id}`;
            });
        });
        
    </script>
</body>
</html>
