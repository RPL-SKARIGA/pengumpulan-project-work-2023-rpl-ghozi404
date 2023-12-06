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
$query = "SELECT id, kategori, nama, spek, deskripsi, harga, img, stok
FROM hardware";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard || Hardware</title>
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
    <script src="validate.js"></script>
    <style>
        .shadow1 {
            /* Horizontal offset, vertical offset, blur radius, spread radius, color */
            box-shadow: 5px 10px 10px 0px rgba(0, 0, 0, 0.193);
            }
        .shadow2 {
            filter: drop-shadow(3px 2px 5px rgba(6, 6, 6, 0.5)); /* Ubah nilai sesuai preferensi Anda */
        }
        .shadow3 {
            filter: drop-shadow(5px 5px 5px rgba(6, 6, 6, 0.2)); /* Ubah nilai sesuai preferensi Anda */
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            appearance: none;
            -webkit-appearance: none;
            margin: 0;
        }
        textarea {
        resize: none;
        }
        .inshadow {
            box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.3);
        }
        .shadowBtn:hover{
            box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.3);
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
    
                <li class="mb-1">
                    <a href="dashboard.php" class="flex gap-2 text-[#f2f2f2] hover:text-gray-400"
                        :class="{'items-center py-2 px-4 hover:bg-[#807e7e72] rounded-xl':buka === true, 'py-2 px-1.5': buka === false}">

                        <i class="fa-solid fa-list text-lg duration-100" ></i>
                        <span class="text-sm":class="{'block':buka, 'hidden':!buka}">Dashboard</span>  
                    </a>
                </li>
                <li class="my-4 shadow2">
                    <a href="adminHardware.php" class="flex gap-2 text-[#f2f2f2] hover:text-gray-400"
                        :class="{'items-center py-2 px-4 hover:bg-[#807e7e72] rounded-r-xl  bg-[#370e44] border-l-4 border-[#810ca8]':buka === true, 'py-2 px-1.5 border-b-[3px] border-[#810ca8] hover:border-[#810ca889]': buka === false}"
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
                    <span class="text-lg font-semibold text-[#00000051]">Tambah Data</span>
                </li>

                <li class="duration-50 " x-bind:class="{ 'ml-[880px]': buka, 'ml-[1070px]' : !buka }" x-data="{ open: false }">
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
        <div class="relative col-span-10 left-64 top-16 m-3 " x-bind:class="{'translate-x-0':buka, 'translate-x-20 left-16':!buka}">
        <form action="../proses/addData.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">

            <div x-data="{ isOpen: false, selectedCategory: 'Select Category', selectedBrand: 'Select Brand', selectedSegment: 'Select Segment', selectedSegment2: 'Select Segment'}"
                 class="bg-[#f2f2f2] rounded-xl border-2 p-6">
                
                <!-- Dropdown category -->
                <div class="w-full shadow3 cursor-pointer">
                    <a @click="isOpen = !isOpen">
                        <div class="flex justify-between bg-[#fdfdfd] border-2 py-4 px-6" :class="{'transform rounded-t-lg': isOpen, 'rounded-xl': !isOpen}">
                            <input class="text-xl font-semibold text-[#2d033b] bg-transparent focus:outline-none cursor-pointer" x-model="selectedCategory" name="selectedCategory" readonly>
                            <i class="duration-150 text-xl fa-solid fa-chevron-right" :class="{'transform rotate-90': isOpen}" ></i>
                        </div>
                    </a>
                    <ul x-show="isOpen" @click.away="isOpen = false" class="relative w-full py-2 bg-[#f2f2f2] rounded-b-xl border-2">
                        <li class="my-4 mx-6">
                            <a href="#" class="duration-150 px-4 py-1 hover:border-l-4 border-[#810ca8] font-semibold text-[#2d033b] hover:text-[#2d033bb7]" @click="selectedCategory = 'Processor'; isOpen = false;">Processor</a>
                        </li>
                        <li class="my-4 mx-6">
                            <a href="#" class="duration-150 px-4 py-1 hover:border-l-4 border-[#810ca8] font-semibold text-[#2d033b] hover:text-[#2d033bb7]" @click="selectedCategory = 'Motherboard'; isOpen = false;">Motherboard</a>
                        </li>
                        <li class="my-4 mx-6">
                            <a href="#" class="duration-150 px-4 py-1 hover:border-l-4 border-[#810ca8] font-semibold text-[#2d033b] hover:text-[#2d033bb7]" @click="selectedCategory = 'VGA Card'; isOpen = false;">VGA Card</a>
                        </li>
                        <li class="my-4 mx-6">
                            <a href="#" class="duration-150 px-4 py-1 hover:border-l-4 border-[#810ca8] font-semibold text-[#2d033b] hover:text-[#2d033bb7]" @click="selectedCategory = 'Power Supply'; isOpen = false;">Power Supply</a>
                        </li>
                        <li class="my-4 mx-6">
                            <a href="#" class="duration-150 px-4 py-1 hover:border-l-4 border-[#810ca8] font-semibold text-[#2d033b] hover:text-[#2d033bb7]" @click="selectedCategory = 'Storage'; isOpen = false;">Storage</a>
                        </li>
                        <li class="my-4 mx-6">
                            <a href="#" class="duration-150 px-4 py-1 hover:border-l-4 border-[#810ca8] font-semibold text-[#2d033b] hover:text-[#2d033bb7]" @click="selectedCategory = 'Memory'; isOpen = false;">Memory</a>
                        </li>
                    </ul>
                </div> 
                <!-- form-->
                <div class="flex gap-6">

                    <!-- processor -->
                    <div x-show="selectedCategory === 'Processor' " class="w-1/2">
                            <div class="flex gap-4">
                                <!-- Dropdown Brand -->
                                <div x-data="{ openCpu: false}" class="my-6 w-full shadow3 cursor-pointer">
                                    <a @click="openCpu = !openCpu">
                                        <div class="flex justify-between bg-[#fdfdfd] py-4 px-6" :class="{'transform rounded-t-lg': openCpu, 'rounded-xl': !openCpu}">
                                            <input class="text-lg font-semibold text-[#2d033b] bg-transparent focus:outline-none cursor-pointer" x-model="selectedBrand" name="Brand" readonly>
                                            <i class="duration-150 text-lg fa-solid fa-chevron-right" :class="{'transform rotate-90': openCpu}" ></i>
                                        </div>
                                    </a>
                                    <ul x-show="openCpu" @click.away="openCpu = false" class="absolute w-full py-2 bg-[#f2f2f2] rounded-b-xl">
                                        <li class="my-4 mx-4">
                                            <a href="#" class="duration-150 px-4 py-1 hover:border-l-4 border-[#2d033b] font-semibold text-[#2d033b] hover:text-[#2d033bb7]" @click="selectedBrand = 'Intel'; openCpu = false;">Intel</a>
                                        </li>
                                        <li class="my-4 mx-4">
                                            <a href="#" class="duration-150 px-4 py-1 hover:border-l-4 border-[#2d033b] font-semibold text-[#2d033b] hover:text-[#2d033bb7]" @click="selectedBrand = 'AMD'; openCpu = false;">AMD</a>
                                        </li>
                                    </ul>
                                </div>
        
                                <!-- dropdown Segment 'Intel' -->
                                <div x-show="selectedBrand === 'Intel'" class="w-full">
        
                                    <div x-data="{ openIntel: false}" class="my-6 w-auto left-64 shadow3 cursor-pointer">
                                        <a @click="openIntel = !openIntel" >
                                            <div class="flex justify-between bg-[#fdfdfd] py-4 px-6" :class="{'transform rounded-t-lg': openIntel, 'rounded-xl': !openIntel}">
                                                <input class="text-lg font-semibold text-[#2d033b] bg-transparent focus:outline-none cursor-pointer" x-model="selectedSegment" name="Segment" readonly>
                                                <i class="duration-150 text-lg fa-solid fa-chevron-right" :class="{'transform rotate-90': openIntel}" ></i>
                                            </div>
                                        </a>
                                        <ul x-show="openIntel" @click.away="openIntel = false" class="absolute w-full py-2 bg-[#f2f2f2] rounded-b-xl">
                                            <li class="my-4 mx-4">
                                                <a href="#" class="duration-150 px-4 py-1 hover:border-l-4 border-[#2d033b] font-semibold text-[#2d033b] hover:text-[#2d033bb7]" @click="selectedSegment = 'i3'; openIntel = false;">i3</a>
                                            </li>
                                            <li class="my-4 mx-4">
                                                <a href="#" class="duration-150 px-4 py-1 hover:border-l-4 border-[#2d033b] font-semibold text-[#2d033b] hover:text-[#2d033bb7]" @click="selectedSegment = 'i5'; openIntel = false;">i5</a>
                                            </li>
                                            <li class="my-4 mx-4">
                                                <a href="#" class="duration-150 px-4 py-1 hover:border-l-4 border-[#2d033b] font-semibold text-[#2d033b] hover:text-[#2d033bb7]" @click="selectedSegment = 'i7'; openIntel = false;">i7</a>
                                            </li>
                                            <li class="my-4 mx-4">
                                                <a href="#" class="duration-150 px-4 py-1 hover:border-l-4 border-[#2d033b] font-semibold text-[#2d033b] hover:text-[#2d033bb7]" @click="selectedSegment = 'i9'; openIntel = false;">i9</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
        
                                <!-- dropdown Seggment 'AMD' -->
                                <div x-show="selectedBrand === 'AMD'" class="w-full">
                                    <div x-data="{ openAMD: false}" class="my-6 shadow3 cursor-pointer">
                                        <a @click="openAMD = !openAMD">
                                            <div class="flex justify-between bg-[#fdfdfd] py-4 px-6" :class="{'transform rounded-t-lg': openAMD, 'rounded-xl': !openAMD}">
                                                <input class="text-lg font-semibold text-[#2d033b] bg-transparent focus:outline-none cursor-pointer" x-model="selectedSegment2" name="Segment">
                                                <i class="duration-150 text-lg fa-solid fa-chevron-right" :class="{'transform rotate-90': openAMD}" ></i>
                                            </div>
                                        </a>
                                        <ul x-show="openAMD" @click.away="openAMD = false" class="absolute w-full py-2 bg-[#f2f2f2] rounded-b-xl">
                                            <li class="my-4 mx-4">
                                                <a href="#" class="duration-150 px-4 py-1 hover:border-l-4 border-[#2d033b] font-semibold text-[#2d033b] hover:text-[#2d033bb7]" @click="selectedSegment2 = 'Ryzen 3'; openAMD = false;">Ryzen 3</a>
                                            </li>
                                            <li class="my-4 mx-4">
                                                <a href="#" class="duration-150 px-4 py-1 hover:border-l-4 border-[#2d033b] font-semibold text-[#2d033b] hover:text-[#2d033bb7]" @click="selectedSegment2 = 'Ryzen 5'; openAMD = false;">Ryzen 5</a>
                                            </li>
                                            <li class="my-4 mx-4">
                                                <a href="#" class="duration-150 px-4 py-1 hover:border-l-4 border-[#2d033b] font-semibold text-[#2d033b] hover:text-[#2d033bb7]" @click="selectedSegment2 = 'Ryzen 7'; openAMD = false;">Ryzen 7</a>
                                            </li>
                                            <li class="my-4 mx-4">
                                                <a href="#" class="duration-150 px-4 py-1 hover:border-l-4 border-[#2d033b] font-semibold text-[#2d033b] hover:text-[#2d033bb7]" @click="selectedSegment2 = 'Ryzen 9'; openAMD = false;">Ryzen 9</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- KOLOM SPESIFIKASI -->
                            <div>
                                <div class="flex gap-4">
                                    <!-- CPU gen -->
                                    <div class="w-full">
                                        <input class="w-full bg-transparent text-lg focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" name="cpu-gen" type="text" placeholder="CPU Generation">
                                    </div>
                                    <!-- Cpu freq -->
                                    <div class="w-full">
                                        <input class="w-full bg-transparent text-lg focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" name="freq" type="text" placeholder="Frequency">
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <!-- cpu core -->
                                    <div class="w-full">
                                        <input class="w-full bg-transparent text-lg focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" name="core" type="number" placeholder="CPU Core">
                                    </div>
                                    <!-- Cpu threads -->
                                    <div class="w-full">
                                        <input class="w-full bg-transparent text-lg focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" name="threads" type="number" placeholder="CPU Threads">
                                    </div>
                                </div>
                                <div>
                                    <!-- tdp -->
                                    <div class="w-full">
                                        <input class="w-full bg-transparent text-lg focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" name="tdp" type="number" placeholder="CPU TDP">
                                    </div>
                                </div>
                                <div>
                                    <!-- description -->
                                    <div class="my-6">
                                        <textarea class="w-full h-32 focus:outline-none py-2 px-4 border-2 border-[#2d033b] rounded-xl bg-transparent" name="deskripsi" id="myTextarea" placeholder="Description..."></textarea>
                                    </div>
                                </div>
                            </div>    
                    </div>
                    
                    <!-- mobo -->
                    <div x-show="selectedCategory === 'Motherboard' " class="w-1/2">
                        <div class="my-6">
                            <!-- name -->
                            <div class="w-full">
                                <input class="w-full bg-transparent text-lg focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" name="nama" type="text" placeholder="Motherboard name">
                            </div>
                            <div class="flex gap-4">
                                <!-- socket -->
                                <div class="w-full">
                                    <input class="w-full bg-transparent text-lg focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" name="socket" type="text" placeholder="Socket">
                                </div>
                                <!-- max memori -->
                                <div class="w-full">
                                    <input class="w-full bg-transparent text-lg focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" name="max-memory" type="text" placeholder="Maximum memory">
                                </div>
                            </div>
                            <!-- input slot memori -->
                            <div>
                                <fieldset class="my-4 pt-1 pb-4 px-4 border-2 border-[#2d033b] rounded-xl">
                                    <legend class="text-lg text-gray-400 px-2">Memory slot</legend>
                                        <div class="grid grid-cols-4 gap-2 rounded-xl bg-gray-200 p-2">
                                            <div class="col-span-2">
                                                <input type="radio" name="memory-slot" id="1" value="2" class="peer hidden" checked />
                                                <label for="1" class="duration-200 block cursor-pointer select-none rounded-xl p-2 text-center font-semibold text-gray-400 peer-checked:bg-[#2d033b] peer-checked:font-bold peer-checked:text-white">2 Slot</label>
                                            </div>

                                            <div class="col-span-2">
                                                <input type="radio" name="memory-slot" id="2" value="4" class="peer hidden" />
                                                <label for="2" class="duration-200 block cursor-pointer select-none rounded-xl p-2 text-center font-semibold text-gray-400 peer-checked:bg-[#2d033b] peer-checked:font-bold peer-checked:text-white">4 Slot</label>
                                            </div>
                                        </div>
                                </fieldset>
                            </div>
                            <!-- deskripsi -->
                            <div class="my-6">
                                <textarea class="w-full h-36 focus:outline-none py-2 px-4 border-2 border-[#2d033b] rounded-xl bg-transparent" name="deskripsi2" id="myTextarea" placeholder="Description..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- vga -->
                    <div x-show="selectedCategory === 'VGA Card' " class="w-1/2">
                        <div class="my-6">
                            <!-- vga name -->
                            <input class="w-full bg-transparent text-lg focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" name="chipset" type="text" placeholder="Chipset / Name">
                            <!-- Specification -->
                            <div class="my-6">
                                <textarea class="w-full h-36 focus:outline-none py-4 px-6 border-2 border-[#2d033b] rounded-xl bg-transparent" name="spek" id="myTextarea" placeholder="VRAM, Core Clock, Bost Clock"></textarea>
                            </div>
                            <!-- deskripsi -->
                            <div class="my-6">
                                <textarea class="w-full h-36 focus:outline-none py-2 px-4 border-2 border-[#2d033b] rounded-xl bg-transparent" name="deskripsi3" id="myTextarea" placeholder="Description..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- psu -->
                    <div x-show="selectedCategory === 'Power Supply' " class="w-1/2">
                        <div class="my-6">
                            <!-- psu name -->
                            <input class="w-full bg-transparent text-lg focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" name="psuName" type="text" placeholder="PSU Name">
                            <!-- psu rating -->
                            <input class="w-full bg-transparent text-lg focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" name="rating" type="text" placeholder="Efficiency Rating">
                            <!-- Wattage -->
                            <input class="w-full bg-transparent text-lg focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" name="wattage" type="number" placeholder="Wattage">
                            <!-- desc -->
                            <div class="my-6">
                                <textarea class="w-full h-44 focus:outline-none py-2 px-4 border-2 border-[#2d033b] rounded-xl bg-transparent" name="deskripsi4" id="myTextarea" placeholder="Description..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Storage -->
                    <div x-show="selectedCategory === 'Storage' " class="w-1/2">
                        <div class="my-6">
                            <!-- storage name -->
                            <input class="w-full bg-transparent text-lg focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" name="romName" type="text" placeholder="Product Name">
                            <!-- storage type -->
                            <div>
                                <fieldset class="my-4 pt-1 pb-4 px-4 border-2 border-[#2d033b] rounded-xl">
                                    <legend class="text-lg text-gray-400 px-2">Storage Type</legend>
                                        <div class="grid grid-cols-4 gap-2 rounded-xl bg-gray-200 p-2">
                                            <div class="col-span-2">
                                                <input type="radio" name="romType" id="3" value="SSD" class="peer hidden" checked />
                                                <label for="3" class="duration-200 block cursor-pointer select-none rounded-xl p-2 text-center font-semibold text-gray-400 peer-checked:bg-[#2d033b] peer-checked:font-bold peer-checked:text-white">SSD</label>
                                            </div>

                                            <div class="col-span-2">
                                                <input type="radio" name="romType" id="4" value="HDD" class="peer hidden" />
                                                <label for="4" class="duration-200 block cursor-pointer select-none rounded-xl p-2 text-center font-semibold text-gray-400 peer-checked:bg-[#2d033b] peer-checked:font-bold peer-checked:text-white">HDD</label>
                                            </div>
                                        </div>
                                </fieldset>
                            </div>
                            <!-- storage capacity -->
                            <input class="w-full bg-transparent text-lg focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" name="capacity" type="text" placeholder="Storage Capacity">
                            <!-- desc -->
                            <div class="my-6">
                                <textarea class="w-full h-36 focus:outline-none py-2 px-4 border-2 border-[#2d033b] rounded-xl bg-transparent" name="deskripsi5" id="myTextarea" placeholder="Description..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- RAM -->
                    <div x-show="selectedCategory === 'Memory' " class="w-1/2">
                        <div class="my-6">
                            <!-- prduct name -->
                            <input class="w-full bg-transparent text-lg focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" name="ramName" type="text" placeholder="Product Name">
                            <!-- memory type -->
                            <div>
                                <fieldset class="my-4 pt-1 pb-4 px-4 border-2 border-[#2d033b] rounded-xl">
                                    <legend class="text-lg text-gray-400 px-2">Memory Type</legend>
                                        <div class="grid grid-cols-6 gap-2 rounded-xl bg-gray-200 p-2">
                                            <div class="col-span-2">
                                                <input type="radio" name="ramType" id="5" value="SSD" class="peer hidden" />
                                                <label for="5" class="duration-200 block cursor-pointer select-none rounded-xl p-2 text-center font-semibold text-gray-400 peer-checked:bg-[#2d033b] peer-checked:font-bold peer-checked:text-white">DDR3</label>
                                            </div>

                                            <div class="col-span-2">
                                                <input type="radio" name="ramType" id="6" value="HDD" class="peer hidden" checked />
                                                <label for="6" class="duration-200 block cursor-pointer select-none rounded-xl p-2 text-center font-semibold text-gray-400 peer-checked:bg-[#2d033b] peer-checked:font-bold peer-checked:text-white">DDR4</label>
                                            </div>

                                            <div class="col-span-2">
                                                <input type="radio" name="ramType" id="7" value="HDD" class="peer hidden" />
                                                <label for="7" class="duration-200 block cursor-pointer select-none rounded-xl p-2 text-center font-semibold text-gray-400 peer-checked:bg-[#2d033b] peer-checked:font-bold peer-checked:text-white">DDR5</label>
                                            </div>
                                        </div>
                                </fieldset>
                            </div>
                            <!-- speed n sz -->
                            <div class="flex gap-4">
                                <!-- speed -->
                                <div class="w-full">
                                    <input class="w-full bg-transparent text-lg focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" name="speed" type="number" placeholder="Enter Memeory Speed">
                                </div>
                                <!-- size -->
                                <div class="w-full">
                                    <input class="w-full bg-transparent text-lg focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" name="size" type="number" placeholder="Size">
                                </div>
                            </div>
                            <!-- desc -->
                            <div class="my-6">
                                <textarea class="w-full h-36 focus:outline-none py-2 px-4 border-2 border-[#2d033b] rounded-xl bg-transparent" name="deskripsi6" id="myTextarea" placeholder="Description..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content -->
                    <div x-show="['Processor', 'Motherboard', 'VGA Card', 'Power Supply', 'Storage', 'Memory'].includes(selectedCategory)" class="w-1/2" id="rightContent">
                            <div class="my-6">

                                        <div x-data="{ image: null}" class="">
                                            <div class="p-6 bg-[#fdfdfd] rounded-xl shadow3">
                                                <!-- tampilan jika gambar false/ kosong -->
                                                <div x-show="!image" class="">
                                                    <div class="h-56 bg-[#f2f2f2] gap-2 flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-400 inshadow">
                                                        <i class="fa-solid fa-images text-4xl text-blue-600"></i>
                                                        <h1 class="font-semibold text-sm">
                                                            <label for="fileInput" class="text-blue-600 cursor-pointer hover:underline">Upload</label>
                                                            <span class="text-black">Image</span>
                                                        </h1>
                                                        <span class="text-xs font-semibold text-[#00000074]">Support: JPEG, JPG, PNG</span>
                                                    </div>
                                                    <div class="mt-6 flex items-center justify-center">
                                                        <label for="fileInput" class="duration-200 cursor-pointer bg-[#810ca8] hover:bg-[#810ca8ac] text-white hover:text-gray-400 py-2 px-24 hover:px-32 rounded-lg hover:rounded-2xl font-semibold">Upload Your File</label>
                                                        <input type="file" id="fileInput" class="sr-only" name="gambar" x-on:change="image = URL.createObjectURL($event.target.files[0])" required>
                                                    </div>
                                                </div>
                                                <!-- tampillan jika gambar true -->
                                                <div x-show="image" class="flex gap-4 ">
                                                    <img :src="image" alt="Uploaded Image" class="h-56 p-4 border-2 border-dashed border-gray-400 rounded-xl max-w-md">
                                                    
                                                    <div class="flex flex-col text-center gap-2">
                                                        <!-- <div class="bg-[#f2f2f2] p-4 rounded-lg inshadow flex flex-col text-center">
                                                            <h1 class="text-left my-2">replace it with another photo</h1>
                                                            <label for="fileInput2" class="cursor-pointer bg-[#810ca8] hover:bg-[#810ca8ac] text-white hover:text-gray-400 py-2 px-4 rounded-lg shadow2">Change Image</label>
                                                            <input type="file" id="fileInput2" class="sr-only" x-on:change="image = URL.createObjectURL($event.target.files[0])">
                                                        </div> -->

                                                        <!-- Delete menu -->
                                                        <div class="bg-[#f2f2f2] p-4 rounded-lg inshadow">
                                                            <h1 class="text-left my-4">delete the image and re-upload</h1>
                                                            <div class="w-full py-2 px-4 bg-red-600 hover:bg-red-500 text-[#fdfdfd] hover:text-[#f2f2f2] rounded-lg shadow2">
                                                                <a href="#" x-on:click=" image = null ">Delete Image</a>                                                         
                                                            </div>
                                                        </div>         
                                                    </div> 
                                                </div>
                                            </div>
                                            
                                            

                                            <div class="flex gap-4 my-4">
                                                <!-- stok -->
                                                <div class="w-full">
                                                    <input class="w-full text-lg bg-transparent focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" required type="number" placeholder="Stok" name="stok">
                                                </div>
                                                <!-- price -->
                                                <div class="w-full">
                                                    <input class="w-full text-lg bg-transparent focus:outline-none py-4 px-6 border-b-2 border-[#2d033b]" required type="number" placeholder="Price" name="harga">
                                                </div>
                                            </div>
                                        </div>

                            </div>
                    </div>

                </div>
                
                <div x-show="['Processor', 'Motherboard', 'VGA Card', 'Power Supply', 'Storage', 'Memory'].includes(selectedCategory)" class="fixed right-[5%] -bottom-10">
                    <input class="duration-200 shadow2 font-semibold text-lg border-[3px] border-[#2d033b] bg-[#2d033b] hover:bg-[#f2f2f2] text-[#f2f2f2] hover:text-[#2d033b] py-4 px-9 rounded-xl shadowBtn" type="submit" value="Add Product">
                </div>
                
            </div>
            
        </form> 
        </div>
    </div>
</body>
</html>
