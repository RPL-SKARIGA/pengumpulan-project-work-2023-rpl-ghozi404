<?php
$isCartPage = (basename($_SERVER['PHP_SELF']) == 'cart.php');
$isViewPage = (basename($_SERVER['PHP_SELF']) == 'productView.php');
require "../proses/koneksi.php";
session_start();

$id = "";
$username = "";
$email = "";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Check if 'id' key is set in the session array
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        
        $query = "SELECT username, email FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if ($row = mysqli_fetch_assoc($result)) {
                $username = $row['username'];
                $email = $row['email'];
            }
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCPARTIFY</title>
    <link rel="icon" href="../asset/img/hei.png" type="image/png">
    <script src="../js/tailwind.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- ALAPINE JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.1/dist/cdn.min.js"></script>
    <style>
        .shadow1 {
            filter: drop-shadow(3px 2px 5px rgb(6, 6, 6)); /* Ubah nilai sesuai preferensi Anda */
        }
        html {
            background-color: #000000;
        }
    </style>
</head>

<body x-data="{ isOpen : false, 
                isClick : false, 
                isCart: <?php echo $isCartPage ? 'true' : 'false'; ?>,
                isView: <?php echo $isViewPage ? 'true' : 'false'; ?>,
                redirectTo: ''
                }" class="font-[poppins] ">

    <header class="fixed py-3 w-full z-50" x-bind:class="{'backdrop-blur-none bg-black':isOpen || isCart || isView, 'backdrop-blur-xl':!(isOpen || isCart || isView)}">
        <nav class="flex justify-between items-center mx-3 lg:mx-9 ">
        <!-- icon dan title dari web -->
            <div class="flex">
                <a href="index.php" class="flex">
                    <!-- icon -->
                    <img class="mt-1 w-9 h-9" src="../asset/img/hei.png" alt="">
                    <!-- nama web -->
                    <h1 style="font-family: 'Bebas Neue', sans-serif;" class="font-semibold mt-1 pl-1 text-yellow-50 text-4xl px-2 cursor-pointer hidden sm:block"><span class="text-yellow-50">PC</span><span class="text-red-500">PART</span>IFY</h1>
                </a>
            </div>

        <!-- konten/menu navbar -->
            <div class="duration-300 max-lg:shadow-lg absolute bg-zinc-950 max-lg:border-2 border-[#00000030] min-h-[40vh] top-full rounded-b-2xl w-full  flex items-center px-9 lg:static lg:bg-transparent lg:duration-0 lg:min-h-fit lg:w-auto z-20" :class="{'left-[0%] opacity-100': isOpen, 'max-lg:left-[-100%] max-lg:opacity-0':!isOpen}">
                <ul class=" flex gap-7 lg:flex-row flex-col lg:items-center  lg:gap-[4vw]">
                    <li class="">
                        <a class="hover:text-gray-400 lg:text-[#f2f2f2] text-[#f2f2f2] text-[14px] font-medium duration-200 max-lg:hover:border-l-[4px] border-[#810ca8] max-lg:hover:px-4 max-lg:hover:py-1" href="index.php">Home</a>
                    </li>
                    <li class="">
                        <a class="hover:text-gray-400 lg:text-[#f2f2f2] text-[#f2f2f2] text-[14px] font-medium duration-200 max-lg:hover:border-l-[4px] border-[#810ca8] max-lg:hover:px-4 max-lg:hover:py-1" href="product.php">Product</a>
                    </li>
                    <li class="">
                        <a class="hover:text-gray-400 lg:text-[#f2f2f2] text-[#f2f2f2] text-[14px] font-medium duration-200 max-lg:hover:border-l-[4px] border-[#810ca8] max-lg:hover:px-4 max-lg:hover:py-1" href="history.php?id=<?= $id ?>">History</a>
                    </li>
                    <li class="">
                        <a class="hover:text-gray-400 lg:text-[#f2f2f2] text-[#f2f2f2] text-[14px] font-medium duration-200 max-lg:hover:border-l-[4px] border-[#810ca8] max-lg:hover:px-4 max-lg:hover:py-1" href="#sikil">About</a>
                    </li>
                </ul>
            </div>

            <div class="flex items-center gap-5 mx-3 lg:mx-0   ">
                <div class="<?php echo isset($_SESSION['username']) ? 'hidden' : 'block'; ?>">
                    <button @click="redirectTo = 'login'; window.location.href = '../u_auth/login.php'" class="duration-300 text-[#f2f2f2] font-semibold text-[13px] px-4 py-2 rounded-2xl bg-transparent hover:text-gray-500 transition-all"><span>Log In</span></button>
                    <button @click="redirectTo = 'signup'; window.location.href = '../u_auth/registrasi.php'" class="duration-300 text-[#f2f2f2] font-semibold text-[13px] px-4 py-2 rounded-2xl bg-[#810ca8] hover:bg-opacity-50 hover:text-gray-400  transition-all"><span>Sign Up</span></button>
                </div>
                <!-- cart -->
                <a href="cart.php" class="<?php echo isset($_SESSION['username']) ? 'block' : 'hidden'; ?>">
                    <i class="text-xl cursor-pointer fa-solid fa-cart-shopping mt-1 text-[#f2f2f2]" ></i>
                </a>
                <!-- user -->
                <i @click="isClick = !isClick" @click.away="isClick = false" id="userIcon" class="duration-300 text-xl cursor-pointer fa-solid <?php echo (isset($_SESSION['username'])) ? 'fa-user-check' : 'fa-user-xmark'; ?>" :class="{'text-gray-500': isClick, 'text-[#f2f2f2]': !isClick}"></i>
                <!-- bar menu -->
                <span class="lg:hidden">
                    <i @click="isOpen = !isOpen" @click.away="isOpen = false" id="menuIcon" class="duration-300 text-xl fa-solid fa-bars cursor-pointer mt-1" :class="{'text-gray-500':isOpen, 'text-[#f2f2f2]':!isOpen}"></i>
                </span>
            </div>
        </nav> 
    </header>

    <!-- popup data akun dan opsi logout -->
    <div class="<?php echo isset($_SESSION['username']) ? 'block' : 'hidden'; ?>">
        <div class="duration-200 fixed max-lg:left-1/2 transform max-lg:-translate-x-1/2 lg:right-0 lg:mx-4 -translate-y-1/2 z-20" :class="{'top-[15%] opacity-100' : isClick, 'top-[-30%] opacity-0':!isClick}">
            <div class="flex justify-between gap-[180px] bg-[#f2f2f2] border-2 border-[#00000030] p-4 rounded-b-xl shadow-lg">    
                <!-- data dari akun user -->
                <ul class="w-[100px]">
                    <li class="flex gap-2">
                        <i class="fa-solid fa-user pt-1" style="color: #000000;"></i>
                        <p class=""><?= $username ?></p>
                    </li>
                    <li class="flex gap-2">
                        <i class="fa-solid fa-envelope pt-1"></i>
                        <p class=""><?= $email ?></p>
                    </li>
                </ul>
                <!-- button log out -->
                <div class="flex justify-center items-center text-center border-l-2 border-gray-400">
                    <a href="../proses/prosesLogout.php" class="flex mx-6 duration-150 gap-2 border-2 bg-[#810ca8] hover:bg-[#f2f2f2] text-[#f2f2f2] hover:border-[#810ca8] hover:text-[#810ca8] py-[3px] px-3 w-[105px] rounded-lg">
                        <i class="fa-solid fa-right-from-bracket pt-1"></i>
                        <p>Logout</p>
                    </a>
                </div>    
            </div>
        </div>
    </div>
    <!-- jika tidak login -->
    <div class="<?php echo isset($_SESSION['username']) ? 'hidden' : 'block'; ?> flex justify-center" >
        <div class="font-[Poppins] duration-200 bg-[#f2f2f2] fixed z-20 flex items-center justify-between gap-6 rounded-md border-l-8 border-[#810ca8] py-4 px-4 top-[10%]" :class="{'scale-100 opacity-100' : isClick, 'scale-0 right-[-100%] opacity-0':!isClick}">
            <i class="fa-solid fa-triangle-exclamation text-yellow-400 text-4xl"></i>
            <h1 class="font-semibold">you are not registered to any account</h1>
            <h1 class="cursor-pointer text-3xl font-bold text-[#2d033b] hover:text-[#810ca8]">&times;</h1>
        </div>
    </div>
</body>
</html>
