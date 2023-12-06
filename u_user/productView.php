<?php
// Sertakan file koneksi.php
include('../proses/koneksi.php');
include 'header.php';
// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Lakukan pengecekan atau query sesuai kebutuhan Anda untuk mendapatkan data produk berdasarkan $id.
    // Misalnya:
    $query = "SELECT * FROM hardware WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $product = mysqli_fetch_assoc($result);
        $kategori = $product['kategori'];
        $name = $product['nama'];
        $spec = $product['spek'];
        $desc = $product['deskripsi'];
        $stok = $product['stok'];
        $price = $product['harga'];
        $img = $product['img'];
    } else {
        // Handle jika query tidak berhasil.
        echo "Gagal mengambil data produk.";
        exit;
    }
} else {
    // Handle jika ID tidak ditemukan atau jika tidak sesuai kebutuhan.
    echo "ID tidak ditemukan.";
    exit;
}
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
        .scroll-container {
            position: relative;
            overflow-y: auto; /* Mengganti overflow-x menjadi overflow-y */
            max-height: 370px; /* Atur tinggi maksimum sesuai kebutuhan */
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
        #btn:hover {
            filter: drop-shadow(0px 2px 15px rgb(69, 15, 206)); /* Ubah nilai sesuai preferensi Anda */
        }
        html {
            background-color: black;
        }
        textarea {
            resize: none;
        }
    </style>
</head>
<body>
    <div class="pt-16">
        <div class="font-[Poppins] max-md:m-4 md:my-6 md:mx-9 flex">
            <div>
                <button @click="redirectTo = 'mainpage'; window.location.href = '../u_user/index.php'" id="btn" class="flex items-center text-center gap-2 duration-200 bg-gradient-to-r from-[#2d033b] to-[#5e1378] hover:from-transparent ring-[3px] ring-transparent hover:ring-inherit text-[#fdfdfd] hover:text-[#f2f2f2] py-3 px-6 font-semibold rounded-lg">
                    <i class="fa-solid fa-arrow-left"></i>
                    <h1>Continue Shopping</h1>
                </button>
            </div>
            <div class="flex items-center mx-6">
                <h1 class="text-gray-300 text-xl font-semibold underline decoration-[#810ca8]">See Product Details</h1>
            </div>
        </div>
        <div class="font-[Poppins] max-md:m-4 md:my-6 md:mx-9 md:flex">
            <div>
                <!-- img product -->
                <div class="flex justify-center p-6 rounded-lg bg-zinc-900">
                    <img class="w-80 rounded-lg shadow-lg" src="<?= $img ?>" alt="">
                </div>
                <!-- stok -->
                <div class="my-4 p-6 bg-zinc-900 rounded-lg">
                    <h1 class="text-gray-300 text-2xl font-semibold">Stok : 50</h1>
                </div>
                <!-- add cart -->
                <div>
                    <a href="../proses/cart.php?id-product=<?= $id?>" id="btn" class="w-full flex justify-center items-center gap-2 duration-200 bg-gradient-to-r from-[#2d033b] to-[#5e1378] hover:from-transparent ring-[3px] ring-transparent hover:ring-inherit text-[#fdfdfd] hover:text-gray-300 py-6 px-6 text-xl font-semibold rounded-lg">
                        <i class="fa-solid fa-cart-plus"></i>
                        <h1>Add to Cart</h1>
                    </a>
                </div>
            </div>
            <div class="max-md:mt-4 md:ml-4">
                <!-- nama barang -->
                <div class="inline-block pt-2 px-3 rounded-t-2xl bg-zinc-900">
                    <h1 class="pb-2 px-3 border-b-4 border-[#4a2f9d] text-yellow-600 font-semibold"><?= $name ?></h1>
                </div>
                <!-- Content 1 -->
                <div class="p-4 bg-zinc-900 gap-4 rounded-tr-xl rounded-b-xl">
                    <div class="scroll-container p-6">
                        <div class="flex flex-col space-y-4 shadow-inner">
                            <!-- Harga -->
                            <div class="font-[Roboto] inline-block bg-gradient-to-r from-[#810ca8] to-[#5e1378] py-2 px-9 rounded-xl shadow2 md:w-[300px]">
                                <h1 class="text-[#f2f2f2] text-3xl font-extrabold">$<?= $price ?></h1>
                            </div>
                            <!-- spek -->
                            <div class="my-6">
                                <textarea class="w-full md:w-[1000px] text-gray-300 h-32 focus:outline-none py-2 px-4 border-2 border-zinc-800 rounded-xl bg-transparent" name="spesifikasi" id="myTextarea" placeholder="Specification..." required><?= $spec ?></textarea>
                            </div>
                            <!-- deskripsi -->
                            <div class="my-6">
                                <textarea class="w-full md:w-[1000px] text-gray-300 h-32 focus:outline-none py-2 px-4 border-2 border-zinc-800 rounded-xl bg-transparent" name="deskripsi" id="myTextarea" placeholder="Description..." required> <?= $desc ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>