<?php

include '../proses/koneksi.php';
include 'header.php';

$id_user = $_SESSION['id'];

$query = "SELECT hardware.*, cart.id_hardware, cart.qty, cart.id_cart 
          FROM hardware 
          JOIN cart ON hardware.id = cart.id_hardware 
          WHERE cart.id_user = $id_user
          ORDER BY cart.created_at DESC";


$result = mysqli_query($conn, $query);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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
    <!-- JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.1/dist/cdn.min.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        .scroll-container {
            position: relative;
            overflow-y: auto; /* Mengganti overflow-x menjadi overflow-y */
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
            display: none;
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            appearance: none;
            -webkit-appearance: none;
            margin: 0;
        }
        .shadow1 {
            /* Horizontal offset, vertical offset, blur radius, spread radius, color */
            box-shadow: 5px 5px 15px 0px rgba(0, 0, 0, 0.300);
        }
        .shadow2:hover {
            /* Horizontal offset, vertical offset, blur radius, spread radius, color */
            box-shadow: 5px 5px 15px 0px rgba(0, 0, 0, 0.300);
        }
        .shadow3 {
            filter: drop-shadow(0px 2px 5px rgb(118, 70, 100)); /* Ubah nilai sesuai preferensi Anda */
        }
        #btn:hover {
            filter: drop-shadow(0px 2px 15px rgb(69, 15, 206)); /* Ubah nilai sesuai preferensi Anda */
        }
        html {
            background-color: #110116;
        }
        textarea {
            resize: none;
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    <div class="pt-16" :class="{'opacity-10':isClick || isOpen, 'opacity-100':!(isClick || isOpen)}">
        <form action="../proses/checkout.php" method="post">
            <div class="">
                <h1 class="font-[Roboto] font-bold text-4xl text-center m-9 text-[#ccc8c8]">Shopping Cart</h1>
            </div>
            <h1 class="<?php echo (mysqli_num_rows($result) > 0) ? 'hidden' : 'block'; ?> text-center text-gray-200 font-bold text-4xl">Your cart is empty, please add some products to the cart <span class="text-yellow-400">:D</span></h1>
            <a href="index.php" class="<?php echo (mysqli_num_rows($result) > 0) ? 'hidden' : 'block'; ?> text-center duration-200 text-blue-400 hover:text-blue-200 hover:underline font-semibold decoration-blue-400 text-2xl my-12 ">Return to the main page</a>
            <?php
            if(mysqli_num_rows($result) > 0){
            ?>
            <div class=" mx-[3%] sm:mx-[10%] lg:mx-[6%] xl:flex gap-12">
                <div class="xl:w-8/12">
                    <div class="font-[Poppins] text-gray-300 font-bold flex py-2 border-b-[3px] border-[#ffffff28]">
                        <h1 class="text-sm">Items in my Cart : </h1>
                    </div>
                    <!-- css skrol skrol -->
                    <div class="scroll-container my-6">
                        <div class="flex flex-col space-y-4 shadow-inner">
                            <!-- ini item cui -->
                            <?php
                                $barang = 0;

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $price = $row['harga'];
                                    $qty = $row['qty'];
                                    
                                    $totalPerRow = $price * $qty;
                                    $total = $barang += $totalPerRow ;
                                
                                ?>

                            <div class=" duration-200 bg-[#1b0622] flex justify-between rounded-xl p-3 shadow2">
                                <div class="flex gap-2">
                                    <div class="flex items-center">
                                        <img class="max-w-[110px] sm:max-w-[120px] rounded-xl shadow1" src="<?= $row['img'] ?>" alt="">
                                    </div>
                                    <div class="p-2">
                                        <ul class="">
                                            <li class="font-[Poppins] px-2 py-1 bg-yellow-300 rounded-lg font-bold">
                                                <h1><?= $row['kategori'] ?></h1>
                                            </li>
                                            <li class="font-[Poppins] py-1 text-gray-300 font-bold max-sm:text-sm max-sm:pt-2">
                                                <h1><?= $row['nama'] ?></h1>
                                            </li>
                                            <li class="font-[Roboto] text-gray-200 text-lg">
                                                <h1>$ <?= $price ?></h1>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <div class="p-2 flex items-center justify-center">
                                        <div class="flex max-xl:flex-col font-[Roboto] font-bold text-center text-[#f2f2f2] border-2 border-gray-400 rounded-lg">
                                            <a href="../proses/qty.php?id_cart=<?= $row['id_cart'] ?>&action=plus" class="order-1 xl:order-3 py-2 px-4 xl:px-2 hover:text-gray-400">
                                                <i class="fa-solid fa-plus"></i>
                                            </a>
                                            <input class="order-2 cursor-help focus:outline-none bg-transparent text-center w-14 xl:w-9" type="number" name="qty" value="<?= $qty ?>" readonly>
                                            <a href="../proses/qty.php?id_cart=<?= $row['id_cart'] ?>&action=minus" class="order-3 xl:order-1 py-2 px-4 xl:px-2 hover:text-gray-400">
                                                <i class="fa-solid fa-minus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="w-[70px] md:w-[80px] xl:w-[150px] font-[Roboto] text-yellow-600 font-bold text-xl flex justify-center items-center px-3">
                                        <!-- total -->
                                        <h1>$<?= $totalPerRow ?></h1>
                                    </div>
                                    <div>
                                        <!-- tombol hapus data -->
                                        <a href="../proses/deleteCart.php?id=<?= $row['id_cart'] ?>" onclick="return confirm('Are you sure you want to delete this item from your cart?')">
                                            <i class="fa-solid fa-xmark cursor-pointer text-gray-400 hover:text-gray-600"></i>
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                            <?php
                                }
                                mysqli_close($conn);
                            ?>
                        </div>
                    </div>
                    <!-- mennu bek n subtotal -->
                    <div class="font-[Poppins] flex justify-between border-t-[3px] border-[#ffffff2b] py-4 gap-4">
                        <div>
                            <button type="button" @click="redirectTo = 'mainpage'; window.location.href = '../u_user/index.php'" id="btn" class="duration-200 bg-gradient-to-r from-[#2d033b] to-[#5e1378] hover:from-transparent ring-[3px] ring-transparent hover:ring-inherit text-[#fdfdfd] hover:text-[#f2f2f2] py-3 px-6 font-semibold rounded-lg">
                                <i class="fa-solid fa-arrow-left mr-1"></i>
                                <span>Continue Shopping</span>
                            </button>
                        </div>
                        <div>
                            <table class="text-[#f2f2f281]">
                                <tr>
                                    <td class="pr-14">Subtotal</td>
                                    <td>
                                        <span class="font-[Roboto] font-semibold">$<?= $total ?></span>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td class="pb-4">Shipping</td>
                                    <td class="pb-4">
                                        <span class="font-[Roboto] font-semibold line-through decoration-0 decoration-gray-300 text-[#ffffff52]">$<?= $total ?></span>
                                    </td>
                                </tr>
                                <tr class="border-t-2 border-[#ffffff4a]">
                                    <td class="text-2xl font-bold text-[#ffffffa3] py-4">Total : </td>
                                    <td class="text-2xl font-bold font-[Roboto] text-yellow-600">$<input class="focus:outline-none bg-transparent" readonly name="total_harga" type="text" value="<?= $total ?>"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div> 
                <!-- cek owt -->
                <div class="xl:w-1/2">
                    <div class="font-[Poppins] text-gray-300 font-bold flex py-2 border-b-[3px] border-[#ffffff28]">
                        <h1 class="text-sm">Checkout form : </h1>
                    </div>
                    <div class="bg-[#1a091f] my-6 p-6 rounded-xl shadow1">
                        <div class="w-full">
                            <h1 class="text-xs text-gray-400 mb-2">Email Confirmation</h1>
                            <input class="w-full bg-[#2d033bbd] rounded-lg text-lg focus:outline-none py-4 px-6 text-gray-400" name="validateEmail" placeholder="Email" value="<?= $email ?>" required>
                        </div>
                        <fieldset class="border-2 p-4 rounded-xl my-6">
                            <legend class="text-gray-400 px-2 mx-2">Address</legend>
                            <div class="w-full">
                                <textarea class="w-full h-36 bg-[#2d033bbd] rounded-lg text-lg focus:outline-none py-4 px-6 text-gray-400" name="address" placeholder='Enter your address' required value=""></textarea>
                            </div>
                        </fieldset>
                        <div>
                            <fieldset class="font-[Roboto] text-sm my-4 pt-1 pb-4 px-4 border-2 rounded-xl">
                                <legend class="text-lg text-gray-400 px-2">Payment method</legend>
                                    <div class="grid grid-cols-6 gap-2 rounded-xl bg-gray-200 p-2">
                                        <div class="col-span-2">
                                            <input type="radio" name="payment" id="5" value="paypal" required class="peer hidden"checked />
                                            <label for="5" class="duration-200 block cursor-pointer select-none rounded-xl p-2 text-center font-semibold text-gray-400 peer-checked:bg-[#2d033b] peer-checked:font-bold peer-checked:text-white italic"><i class="fa-brands fa-paypal mr-1"></i>Paypal</label>
                                        </div>
                                        <div class="col-span-2">
                                            <input type="radio" name="payment" id="6" value="amazon" required class="peer hidden" />
                                            <label for="6" class="duration-200 block cursor-pointer select-none rounded-xl p-2 text-center font-semibold text-gray-400 peer-checked:bg-[#2d033b] peer-checked:font-bold peer-checked:text-white"><i class="fa-brands fa-amazon-pay mr-1"></i>Amazon Pay</label>
                                        </div>

                                        <div class="col-span-2">
                                            <input type="radio" name="payment" id="7" value="visa" required class="peer hidden" />
                                            <label for="7" class="duration-200 block cursor-pointer select-none rounded-xl p-2 text-center font-semibold text-gray-400 peer-checked:bg-[#2d033b] peer-checked:font-bold peer-checked:text-white italic"><i class="fa-brands fa-cc-visa mr-1"></i>VISA</label>
                                        </div>
                                    </div>
                            </fieldset>
                        </div>
                        <!-- desc -->
                        <div class="w-full my-6">
                            <textarea class="w-full h-36 bg-[#2d033bbd] rounded-lg text-lg focus:outline-none py-4 px-6 text-gray-400" name="deskripsi" placeholder='Description "Optional"' value=""></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" id="btn" class="duration-200 w-1/2 bg-gradient-to-r from-[#2d033b] to-[#5e1378] hover:from-transparent ring-[3px] ring-transparent hover:ring-inherit text-[#fdfdfd] hover:text-[#f2f2f2] py-3 px-6 font-semibold rounded-lg">
                                <i class="fa-solid fa-boxes-packing mr-1"></i>
                                <span>Checkout</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </form>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>
