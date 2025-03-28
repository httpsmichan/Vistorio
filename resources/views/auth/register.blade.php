<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-[url('/images/houseBG.jpg')] bg-cover bg-center">

<!-- Back Button Section -->
<div class="absolute top-5 left-5">
    <a href="{{ route('welcome') }}" class="w-10 h-10 flex items-center justify-center bg-gray-900/50 text-white rounded-full border border-white/50 hover:bg-gray-900/70 hover:border-white/70 transition">
        &times; <!-- "X" Icon -->
    </a>
</div>


    <!-- Outer Container (Holds Everything) -->
    <div id="transition-container" class="bg-white pt-[10px] pl-[10px] pb-[10px] w-full max-w-4xl flex items-center justify-center rounded-bl-[3rem] overflow-hidden opacity-0 translate-y-10 transition-all duration-1000 min-h-[500px] shadow-2xl">
        
    <!-- Image Section -->
        <div class="w-3/5 bg-white flex justify-center items-center relative rounded-br-[4rem]">
            <img src="{{ asset('images/pic1.jpg') }}" 
                alt="Login Image" 
                class="shadow-md w-full h-auto object-cover rounded-tr-[3rem] rounded-bl-[3rem] 
                    transition-all duration-500 hover:scale-95 hover:brightness-90">
            <!-- Navigation Buttons (Lower Right) -->
            <div class="absolute bottom-4 left-4 flex gap-3">
                <button class="w-10 h-10 flex items-center justify-center bg-gray-400/50 text-white rounded-full border border-white/50 hover:bg-gray-500/70 hover:border-white/70 transition">
                    &#8592; <!-- Left Arrow -->
                </button>
                <button class="w-10 h-10 flex items-center justify-center bg-gray-400/50 text-white rounded-full border border-white/50 hover:bg-gray-500/70 hover:border-white/70 transition">
                    &#8594; <!-- Right Arrow -->
                </button>
            </div>
        </div>

    <!-- Register Form Section (Optimized for Minimal Padding & Margins) -->
    <div class="w-2/5 bg-white flex flex-col justify-center items-center p-4 relative pt-16">

                <h2 class="text-lg font-semibold text-center w-full">Register</h2>

                @if (session('success'))
                    <div class="bg-green-500 text-white p-3 rounded-md mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-500 text-white p-3 rounded-md mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


            <form action="{{ route('register') }}" method="POST" class="w-4/5">
                @csrf

                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-medium">Full Name:</label>
                    <input type="text" name="name" required 
                        class="w-full text-sm p-1.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-medium">Email:</label>
                    <input type="email" name="email" required 
                        class="w-full text-sm p-1.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <!-- Password & Confirm Password Side by Side -->
                <div class="mb-3 flex space-x-3">
                    <!-- Password -->
                    <div class="w-1/2">
                        <label class="block text-gray-700 text-sm font-medium">Password:</label>
                        <input type="password" name="password" required 
                            class="w-full text-sm p-1.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
                    </div>

                    <!-- Confirm Password -->
                    <div class="w-1/2">
                        <label class="block text-gray-700 text-sm font-medium">Confirm Password:</label>
                        <input type="password" name="password_confirmation" required 
                            class="w-full text-sm p-1.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
                    </div>
                </div>

                <button type="submit" 
                        class="w-full bg-black text-white py-1.5 rounded-md hover:bg-gray-800 transition text-sm">
                    Register
                </button>
            </form>

            <p class="mt-2 text-sm text-gray-600">
                Already have an account?  
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline transition-all duration-300">Log in here</a>
            </p>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const container = document.getElementById("transition-container");
            container.classList.remove("opacity-0", "translate-y-10");
        });
    </script>
</body>
</html>