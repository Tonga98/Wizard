<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <title>Wizard S.R.L</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="max-h-screen min-h-screen h-screen w-screen bg-gray-100">

        <!--Page heading-->
        <header class="flex lg:flex-row flex-col justify-between lg:border-b-2 lg:h-1/6">
            <!--Name-->
            <h1 class="text-5xl text-center block my-5 lg:m-auto font-ModernAntiqua">WIZARD S.R.L</h1>

            <!--Page nav-->
            @include('layouts.nav')

        </header>

        <!---Page content-->
        <main class="">
            @yield('content')
        </main>

    </body>
</html>
