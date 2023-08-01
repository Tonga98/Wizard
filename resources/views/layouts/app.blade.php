<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <title>Wizard S.R.L</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="md:h-screen bg-no-repeat bg-cover bg-center" style="background-image: url({{asset('img/fondo.jpeg')}})">

             <!--Page heading-->
             <header class="md:flex justify-between md:border-b-2 md:h-1/6">
                 <!--Name-->
                 <h1 class="text-4xl text-center my-5 md:m-auto">Wizard S.R.L</h1>

                 <!--Page nav-->
                 @include('layouts.nav')

             </header>

             <!---Page content-->
             <main class="h-5/6">
                 @yield('content')
             </main>

    </body>
</html>
