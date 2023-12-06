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

// select semua data
$query = "SELECT * FROM hardware";

// menampilkan data yang dicari
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $query .= " WHERE kategori LIKE '%$keyword%' OR nama LIKE '%$keyword%' OR id LIKE '%$keyword%'";
}

$result = mysqli_query($conn, $query);

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
                    <span class="text-lg font-semibold text-[#00000051]">Product / Hardware</span>
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
        <div class="relative col-span-10 left-64 top-16 m-4" x-bind:class="{'translate-x-0':buka, 'translate-x-20 left-16':!buka}">
            
            <!-- Search Bar -->
            <form action="adminHardware.php" method="GET">
            <div x-data="{ isOpen: false, selectedCategory: 'Search by Category' }" class="flex bg-[#FDFDFD] shadow3 my-4 p-2 rounded-2xl gap-4">
                <!-- search by name -->
                <div class="flex w-full">
                    <input class="focus:outline-none shadow-inner w-full bg-[#f2f2f2] p-3 rounded-l-2xl border-2" type="text" name="keyword" placeholder="Search by name and Id..." autocomplete="off">
                    <button type="submit" name="cari" class="group duration-200 text-2xl bg-[#2d033b] hover:bg-[#4d265a] text-[#f2f2f2] px-4 rounded-r-2xl flex items-center">
                        <i class="fa-solid fa-magnifying-glass group-hover:animate-pulse"></i>
                    </button>
                </div>
            </div>
            </form>

            <!-- Tabel produk -->
            <div id="tabelProduk" class="shadow3 absolute -z-10">

                <div class="p-6 bg-[#f2f2f2] rounded-t-xl rounded-br-xl border-x-2 border-t-2">
                    
                    <div class="flex max-2xl:justify-center">
                        <table class="shadow-lg bg-[#2d033b64] rounded-b-2xl">
                            <thead class="font-['Poppins'] bg-[#2d033b]">
                                <tr class="text-white text-sm">
                                    <th class="font-medium max-2xl:px-4  px-9 py-3">ID</th>
                                    <th class="font-medium max-2xl:px-4  px-9 py-3">Image</th>
                                    <th class="font-medium max-2xl:px-4  px-9 py-3">Category</th>
                                    <th class="font-medium max-2xl:px-4  px-9 py-3">Name</th>
                                    <th class="font-medium max-2xl:px-4  px-9 py-3">Specification</th>
                                    <th class="font-medium max-2xl:px-4  px-9 py-3">Description</th>
                                    <th class="font-medium max-2xl:px-4  px-9 py-3">Stock</th>
                                    <th class="font-medium max-2xl:px-4  px-9 py-3">Price</th>
                                    <th class="font-medium max-2xl:px-4  px-12 py-3">Action</th>
                                </tr>
                            </thead>
                
                            <tbody class="duration-200 font-light text-sm bg-[#FDFDFD]">
                                <?php
                                $isEven = true;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $spek = $row['spek'];
                                    $deskripsi = $row['deskripsi'];

                                    // Periksa panjang spek dan deskripsi, dan potong jika lebih dari 20 karakter
                                    if (strlen($spek) > 20) {
                                        $spek = substr($spek, 0, 20) . ".....";
                                    }

                                    if (strlen($deskripsi) > 20) {
                                        $deskripsi = substr($deskripsi, 0, 20) . ".....";
                                    }
                                    $rowClass = $isEven ? 'bg-[#FDFDFD] hover:bg-yellow-100' : 'bg-[#f2f2f2] hover:bg-yellow-100';
                                    $isEven = !$isEven;
                
                                    ?>
                                    <tr class="text-center border-b-2 border-[#0000001f] <?= $rowClass; ?>">
                                        <td class="px-6"><?= $row['id'] ?></td>
                                        <td class="px-6"><img src="<?= $row['img'] ?>" alt="" class="duration-200 cursor-pointer aspect-video object-cover w-20 mx-auto my-1 shadow-lg hover:scale-x-90"></td>
                                        <td class="px-6"><?= $row['kategori']?></td>
                                        <td class="px-6"><?= $row['nama']?></td>
                                        <td class="px-6"><?= $spek?></td>
                                        <td class="px-6"><?= $deskripsi?></td>
                                        <td class="px-6"><?= $row['stok']?></td>
                                        <td class="px-6"><?= $row['harga']?></td>
                                        <td class="px-6">
                                            <button class="duration-300 text-xl px-2 py-1 rounded-md bg-yellow-500 hover:bg-yellow-200 text-white my-1 btnEdit" data-id="<?= $row['id'] ?>">
                                                <i class="fa fa-pen"></i>
                                            </button>
                                            <button class="duration-300 text-xl px-2 py-1 rounded-md bg-red-900 hover:bg-red-500 text-white my-1 btnHapus" data-id="<?= $row['id'] ?>">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php }
                                // Tutup koneksi database
                                mysqli_close($conn);
                                ?>
                            </tbody>
                            <tbody class="">
                                <tr class="text-center">
                                    <td></td><td></td>
                                    <td><h1 class="<?php echo mysqli_num_rows($result) <= 0 ? 'block' : 'hidden'; ?> font-semibold text-lg ">Data Kosong</h1></td>
                                    <td></td><td></td><td></td><td></td>
                                    <td class="border-l-2 border-gray-400">
                                        <!-- button Lainnya-->
                                        <div class="duration-200 m-3 inline-block py-2 px-3 rounded-lg shadow-md bg-[#2d033b] text-[#f2f2f2] hover:bg-[#810ca8] hover:text-[#FDFDFD]">
                                            <a href="tambahData.php" class="flex font-semibold gap-2">
                                                <i class="fa-regular fa-square-plus text-lg"></i>
                                                <span class="mt-0.5">Tambah</span>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="border-l-2 border-gray-400">
                                        <!-- button Lainnya-->
                                        <div class="duration-200 m-3 inline-block py-2 px-3 rounded-lg shadow-md bg-[#2d033b] text-[#f2f2f2] hover:bg-[#810ca8] hover:text-[#FDFDFD]">
                                            <a href="" class="flex font-semibold gap-2">
                                                <i class="fa-solid fa-eye text-lg"></i>
                                                <span class="mt-0.5">Lainnya</span>
                                            </a>
                                        </div>
                                    </td>   
                                </tr>
                                
                            </tbody>
                           
                        </table>
                    </div>
                    
                </div>
                 <!-- Label Tabel produk -->
                <div class="inline-block bg-[#f2f2f2] px-4 rounded-b-2xl border-x-2 border-b-2 mb-14">
                        <h1 class="font-semibold text-lg py-2 px-4 border-t-[3px] border-[#810ca8]">Tabel Produk</h1>
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
