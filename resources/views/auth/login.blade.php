<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-[url('/images/houseBG.jpg')] bg-cover bg-center">
    <div id="transition-container" 
        class="bg-white pt-[10px] pr-[10px] pb-[10px] w-full max-w-4xl flex items-center justify-center rounded-br-[3rem] overflow-hidden opacity-0 translate-y-10 transition-all duration-1000 min-h-[500px] shadow-2xl">
        <!-- Back Button Section -->
        <div class="absolute top-5 left-5">
            <a href="{{ route('welcome') }}" class="w-10 h-10 flex items-center justify-center bg-gray-900/50 text-white rounded-full border border-white/50 hover:bg-gray-900/70 hover:border-white/70 transition">&times;</a>
        </div>

        <!-- Login Form Section -->
        <div class="w-2/5 bg-white flex flex-col justify-center items-center p-4 relative pt-10">
            <h2 class="text-lg font-semibold text-center w-full">Login</h2>

            <!-- Display Errors -->
            @if ($errors->any())
                <div class="mb-4 text-red-500 text-sm text-center">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="w-3/4">
                @csrf
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-medium">Email:</label>
                    <input type="email" name="email" required 
                        class="w-full text-sm p-1.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-medium">Password:</label>
                    <input type="password" name="password" required 
                        class="w-full text-sm p-1.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <button type="submit" 
                        class="w-full bg-black text-white py-1.5 rounded-md hover:bg-gray-800 transition text-sm">
                    Login
                </button>
            </form>

            <p class="mt-3 text-sm text-gray-600">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline transition-all duration-300">Register here</a>
            </p>
        </div>

        <!-- Image Section -->
        <div class="w-3/5 bg-white flex justify-center items-center relative rounded-br-[4rem]">
            <img src="{{ asset('images/login.jpg') }}" 
                alt="Login Image" 
                class="shadow-md w-full h-auto object-cover rounded-tl-[3rem] rounded-br-[3rem] transition-all duration-500 hover:scale-95 hover:brightness-90">
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