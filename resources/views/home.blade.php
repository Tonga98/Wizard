@extends('layouts.myApp')

@section('content')
<div class="h-full flex justify-around items-center">
    <div class="min-w-min h-min border border-gray-500/50 shadow-2xl p-2 bg-slate-300/50">
        <h2 class="text-xl mb-2 ml-1">Atencion!</h2>

        <ul class="h-min p-5 max-w-sm md:max-w-none font-medium text-base">
            <li><a href="" class="hover:cursor-pointer hover:underline opa">- Vencimiento Lic.conducir "Chofer 1 asddddddddddddddd"</a></li>
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
