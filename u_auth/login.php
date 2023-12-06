<!DOCTYPE html>
<html>
<head>
    <title>PCPARTIFY | Login</title>
    <link rel="icon" href="../asset/img/hei.png" type="image/png">
   <!-- TAILWIND CSS -->
   <script src="../js/tailwind.js"></script>
   <link rel="stylesheet" href="textAnm.css">
   <!-- FONT -->
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family>Bebas+Neue&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Mono&display=swap" rel="stylesheet">
   <!-- ICON / LOGO -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
   <!-- ALAPINE JS -->
   <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.1/dist/cdn.min.js"></script>
   
    <style>
        #logImg {
            filter: drop-shadow(0px 4px 15px rgba(255, 255, 255, 0.093)); /* Ubah nilai sesuai preferensi Anda */
        }
        #txtS {
            filter: drop-shadow(0px 4px 15px rgba(14, 155, 221, 0.633)); /* Ubah nilai sesuai preferensi Anda */
        }
        .shadow1 {
            filter: drop-shadow(0px 4px 5px rgba(0, 0, 0, 0.441)); /* Ubah nilai sesuai preferensi Anda */
        }
        #btn {
            filter: drop-shadow(0px 4px 5px rgba(0, 0, 0, 0.348)); /* Ubah nilai sesuai preferensi Anda */
        }
        #btn:hover {
            filter: drop-shadow(0px 2px 10px rgba(104, 15, 206, 0.437)); /* Ubah nilai sesuai preferensi Anda */
        }
    </style>
</head>
<body class="bg-[#f2f2f2]">
    
        <div class="grid lg:grid-cols-12 lg:grid-rows-6 lg:h-screen">
            
            <!-- konten -->
            <div class="lg:row-span-4 lg:col-start-2 lg:col-span-5 lg:row-start-2 max-lg:rounded-xl lg:rounded-l-2xl bg-[#001524] shadow1  max-lg:m-3 ">
                <!-- MAX LG SCREEN -->
                <div class="p-3 grid grid-cols-8 lg:h-full lg:grid-rows-5 lg:py-6 lg:hidden">
                    <div class="col-span-5 lg:flex lg:col-span-8 ">
                        <!-- icon dan title dari web -->
                        <div class="flex max-lg:pt-6 mx-4 pb-6 max-lg:w-[160px] max-lg:border-b-2 border-[#fdfdfd5d] ">
                            <!-- icon IMAGE 1-->
                            <img class="w-9 h-9" src="../asset/img/hei.png" alt="">
                            <!-- nama web -->
                            <h1 style="font-family: 'Bebas Neue', sans-serif;" class="font-semibold pl-1 text-yellow-50 text-4xl px-2 cursor-pointer"><span class="text-yellow-50">PC</span><span class="text-red-500">PART</span>IFY</h1>
                        </div>
                    
                        <!-- Kontennn -->
                        <div class="px-4 max-lg:mt-2 sm:pr-9 sm:mt-4 md:mt-6 md:pr-12 lg:mt-0 text-gray-300 lg:py-2">
                            <!-- text 1 -->
                            <span class="text-3xl sm:text-4xl md:text-5xl lg:text-3xl font-bold tracking-tighter">
                                Hi, Welcome to
                                <span style="font-family: 'Bebas Neue', sans-serif;" class="tracking-wide font-extrabold text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">PCPARTIFY.</span>
                            </span>  
                        </div>                        
                    </div>
                        <!-- IMAGE 2 -->
                        <img class="col-span-3 pt-3 pb-3 " id="logImg" src="../asset/img/[removal.ai]_3ab239b4-1109-4fd8-b988-6006a3a9a912-12146011_wavy_gen-01_single-07_3KN79M (1).png" class="w-full">
                </div>
                <!-- MIN LG SCREEN -->
                <div class="hidden lg:block">
                    <!-- mini header -->
                    <div class="p-4 bg-[#122533] shadow1 rounded-tl-2xl">
                        <div class="flex">
                            <!-- LOGO -->
                            <img class="mt-1 w-9 h-9" src="../asset/img/hei.png" alt="">
                            <!-- WEB TITLE -->
                            <h1 style="font-family: 'Bebas Neue', sans-serif;" class="font-semibold mt-1 pl-1 text-yellow-50 text-4xl px-2 cursor-pointer"><span class="text-yellow-50">PC</span><span class="text-red-500">PART</span>IFY</h1>
                        </div>
                    </div>
                    <!-- CONTENT -->
                    <div class="">
                        <div class="p-4">
                            <span class="text-[#f2f2f2] text-4xl font-bold tracking-tighter" >
                                Hi, Welcome to
                                <span style="font-family: 'Bebas Neue', sans-serif;" class="tracking-wide font-extrabold text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400" id="txtS">PCPARTIFY.</span>
                            </span>
                        </div>
                        <div class="flex justify-center">
                            <img class="py-3 px-4 w-[300px]" id="logImg" src="../asset/img/[removal.ai]_3ab239b4-1109-4fd8-b988-6006a3a9a912-12146011_wavy_gen-01_single-07_3KN79M (1).png">
                        </div>
                    </div>
                </div>
            </div>

            <!-- konten 2 -->
            <div class="font-[Poppins] max-lg:mt-4 lg:row-span-4 lg:row-start-2 lg:col-start-7 lg:col-span-5 lg:bg-[#FDFDFD] lg:shadow-xl lg:border-2 lg:rounded-r-2xl">

                <form method="POST" action="../proses/login.php" >
                    <h1 class="text-center text-3xl font-extrabold tracking-tight lg:mt-9">Sign In</h1>

                    <!-- text fields username -->
                    <div class="relative flex mt-4 border-b-2 border-gray-400 mx-16">
                        <div class="relative inset-y-0 flex items-center">
                            <i class="fa-solid fa-user text-gray-500"></i>
                        </div>
                        <input class=" focus:outline-none bg-transparent py-1 pl-2 w-full placeholder-gray-500" type="text" name="username" id="username" placeholder="Username" required>
                    </div>
                    <!-- text fields password -->
                    <div class="relative flex mt-4 border-b-2 border-gray-400 mx-16">
                        <div class="relative inset-y-0 flex items-center">
                            <i class="fa-solid fa-key text-gray-500"></i>
                        </div>
                        <input class=" focus:outline-none bg-transparent py-1 pl-2 w-full placeholder-gray-500" type="password" name="password" id="password" placeholder="Password" required>
                    </div>

                    <!-- tombol login -->
                    <div class="relative flex mx-16 mt-4 shadow1">
                        <input class="duration-200 bg-purple-700 border-[3px] border-transparent text-white py-1 text-center rounded-xl cursor-pointer hover:bg-transparent hover:border-purple-700 hover:text-purple-700 w-full" type="submit" value="Login">
                    </div>

                    <!-- tombol lupa sandi -->
                    <div class="flex justify-center m-3 mb-4">
                        <a href="#" class="text-sm font-semibold text-blue-950 hover:text-gray-600 hover:underline">Forgot password?</a>
                    </div>
                </form>

                <!-- register / login jika punya akun-->
                <div class="m-3">
                    <div class="bg-[#001524] shadow1 p-6 lg:p-3 lg:mx-6 rounded-xl">
                        <!-- text 2 -->
                        <p class="font-[Poppins] mt-2 text-center text-gray-300">please enter your account to continue</p>
                        <!-- garis /or/ -->
                        <div class="inline-flex items-center justify-center w-full">
                            <hr class="w-64 h-0.5 my-6 bg-gray-200 border-0 dark:bg-gray-700">
                            <span class="absolute px-3 font-medium text-[#001524] -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-[#001524]">or</span>
                        </div>
                        <!-- text 3 -->
                        <p class="font-[Poppins] text-center text-gray-300">don't have an account?</p>
                        <!-- button register -->
                        <div class="flex justify-center mt-4 mb-2">
                            <a href="registrasi.php" id="btn" class="duration-100 text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg hover:rounded-2xl text-md px-20 hover:px-24 pb-2.5 pt-2 lg:px-12 lg:hover:px-16 xl:px-20 xl:hover:px-24">Sign Up</a>
                        </div>
                    </div>
                </div>            
            </div>
            
            
        </div>
        
</body>
</html>
