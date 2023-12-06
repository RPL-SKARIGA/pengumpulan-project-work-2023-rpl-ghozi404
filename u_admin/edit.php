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
    $nama = $row['name'];
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
 
    $query = "SELECT * FROM hardware WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    if ($result) {

        $row = mysqli_fetch_assoc($result);
        $kategori = $row['kategori'];
        $nama = $row['nama'];
        $spec = $row['spek'];
        $desc = $row['deskripsi'];
        $stok = $row['stok'];
        $price = $row['harga'];
        $img = $row['img'];

    } else {

        echo "Gagal mengambil data produk.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard || Hardware</title>
    <link rel="icon" href="../asset/img/hei.png" type="image/png">
    <link rel="stylesheet" href="../js/customScrollBar.css">
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
    
    <style>
        .shadow1 {
            /* Horizontal offset, vertical offset, blur radius, spread radius, color */
            box-shadow: 5px 10px 10px 0px rgba(0, 0, 0, 0.193);
            }
        .shadow2 {
            filter: drop-shadow(3px 2px 5px rgba(6, 6, 6, 0.5)); /* Ubah nilai sesuai preferensi Anda */
        }
        .shadow3 {
            filter: drop-shadow(0px 5px 5px rgba(6, 6, 6, 0.2)); /* Ubah nilai sesuai preferensi Anda */
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            appearance: none;
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body class="bg-[#FDFDFD] font-[Poppins]" >
<form action="../proses/prosesEdit.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
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
                    <span class="text-lg font-semibold text-[#00000051]">Edit Data</span>
                </li>

                <li class="duration-50" x-bind:class="{ 'ml-[920px]': buka, 'ml-[1100px]' : !buka }" x-data="{ open: false }">
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
            <div class="flex flex-col gap-4">
                <div class="p-6 bg-[#f2f2f2] rounded-xl border-2 shadow-lg">
                    <div class="flex max-2xl:justify-center gap-6">
                        <div class="flex w-1/2">
                            <div class="rounded-l-xl border-[3px] border-dashed border-gray-300 p-1">
                                <img id="imagePreview" class="aspect-square max-w-[250px] rounded-l-xl" src="<?= $img ?>" alt="Default Image">
                            </div>
                            <div class="flex flex-col bg-gray-300 w-full rounded-r-xl p-6 gap-3">
                                <input type="file" name="gambar" id="imageInput" style="display: none" onchange="previewImage()">
                                <div>
                                    <button type="button" onclick="document.getElementById('imageInput').click()" class="shadow3 bg-[#2d033b] text-[#f2f2f2] border-[3px] border-transparent hover:bg-transparent hover:text-gray-700 hover:border-[#2d033b] duration-200 py-4 w-full font-semibold rounded-xl"><i class="fa-solid fa-pen-to-square mr-2"></i>Ganti gambar</button>
                                </div>
                                <div>
                                    <p class="m-1 text-xs">File Path :</p>
                                    <h1 class="bg-gray-400 text-center py-2 px-2 rounded-lg shadow3" id="imagePath">img dari product 000</h1>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2">
                            <div class="bg-gray-300 p-4 rounded-xl shadow3">
                                <h1 class="text-2xl font-semibold text-[#2d033b]">Kategori : <span class="underline decoration-yellow-[#2d033b]"><?= $kategori ?></span></h1>
                            </div>
                            <div>
                                <input class="my-6 py-4 px-6 text-xl w-full border-b-4 border-[#2d033b] focus:outline-none bg-transparent" type="text" name="name" value="<?= $nama ?>" placeholder="Nama Produk">
                            </div>
                            <div class="flex gap-6">
                                <input class="py-4 px-6 text-xl w-full border-b-4 border-[#2d033b] focus:outline-none bg-transparent" type="number" name="stok" value="<?=  $stok ?>" placeholder="Stok">
                                <input class="py-4 px-6 text-xl w-full border-b-4 border-[#2d033b] focus:outline-none bg-transparent" type="number" name="price" value="<?= $price ?>" placeholder="Harga">
                            </div>
                        </div>
                    </div>     
                </div>
                <div class="p-6 bg-[#f2f2f2] rounded-xl border-2 shadow-lg">
                    <div class="flex flex-col max-2xl:justify-center gap-4">
                        <!-- spek -->
                        <div>
                            <textarea class="w-full h-36 focus:outline-none py-2 px-4 border-2 border-zinc-800 rounded-xl bg-transparent" name="spec" id="myTextarea" placeholder="Specification..." required><?= $spec ?></textarea>
                        </div>
                        <!-- deskripsi -->
                        <div>
                            <textarea class="w-full h-36 focus:outline-none py-2 px-4 border-2 border-zinc-800 rounded-xl bg-transparent" name="deskripsi" id="myTextarea" placeholder="Description..." required><?= $desc ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed right-4 bottom-4">
            <button data-id="<?= $row['id'] ?>" class="btnSave bg-[#2d033b] text-[#f2f2f2] border-4 border-transparent hover:bg-[#f2f2f2] hover:text-[#2d033b] hover:border-[#2d033b] duration-200 py-4 px-6 text-xl rounded-xl font-semibold shadow3" type="submit">
                <i class="fa-solid fa-floppy-disk mr-1"></i>
                Simpan
            </button>
        </div>
    </div>
    </form>
    <script>
        function previewImage() {
            var input = document.getElementById('imageInput');
            var preview = document.getElementById('imagePreview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
                document.getElementById('imagePath').innerText = file ? file.name : "img dari product 000";
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }

    </script>
</body>
</html>
