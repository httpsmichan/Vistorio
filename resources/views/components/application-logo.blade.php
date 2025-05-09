<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Logo</title>

    <!-- Google Fonts Link for Rowdies Font -->
    <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    <div class="text-md font-rowdies font-bold text-black flex items-center">
        <img src="{{ asset('images/logo.jpg') }}" alt="{{ config('app.name') }}" 
             {{ $attributes->merge(['class' => 'h-9 w-9 rounded-full object-cover mr-2']) }} />
    </div>
</body>
</html>
