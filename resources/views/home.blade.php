@extends('layouts.myApp')

@section('content')
<div class="h-full flex justify-between align-content-center">
    <div class="mx-auto mt-8 md:mt-14 min-w-min h-min card">
        <h2 class="text-xl mb-2 ml-1">Atencion!</h2>

        <ul class="h-min p-5 max-w-sm md:max-w-none font-medium text-base">
            <li><a href="" class="hover:cursor-pointer hover:underline">- Vencimiento Lic.conducir "Chofer 1 asddddddddddddddd"</a></li>
            <li><a href="" class="hover:cursor-pointer hover:underline">- Vencimiento Ant.provinciales "Chofer 2"</a></li>
            <li><a href="" class="hover:cursor-pointer hover:underline"> - Vencimiento Linti "Chofer 3"</a></li>
            <li><a href="" class="hover:cursor-pointer hover:underline"> - Vencimiento Lic.conducir "Chofer 1"</a></li>
        </ul>

    </div>

    <!--List of the menu-->
    @if(isset($list))
        <x-list :list="$list" :title="$title" :link="$link"></x-list>
    @else
        <x-options></x-options>
    @endif
</div>
@endsection
