<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Licitadocs</title>
    <!--
    <link href="{ asset('build/app.css') }}" rel="stylesheet">
    <script src="{ asset('build/app.js') }}" defer></script>
    -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-dark text-light ">
    <div >
        @yield('content')
    </div>
</body>
</html>