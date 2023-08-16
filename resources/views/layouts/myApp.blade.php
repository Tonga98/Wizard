<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <title>Wizard S.R.L</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="max-h-screen min-h-screen h-screen w-screen" >

        <!--Page heading-->
        <header class="flex lg:flex-row flex-col justify-between lg:border-b-2 border-slate-500 lg:h-16 bg-slate-300">
            <!--Name-->
            <h1 class="text-5xl text-center block my-5 lg:m-auto font-ModernAntiqua">WIZARD S.R.L</h1>

            <!--Page nav-->
            @include('layouts.nav')

        </header>

        <!---Page content-->
        <main class="bg-no-repeat bg-cover bg-bottom" style="background-image: url({{asset("../img/fondo.jpeg")}}); height: calc(100vh - 64px);">
            @yield('content')
        </main>

    </body>
</html>
