@extends('layouts.myApp')

@section('content')
<section class="h-full flex justify-around items-center">
    @if(isset($vencidos))
    <aside class="min-w-min h-min border border-gray-500/50  p-2 cardBlur">
        <h2 class="text-2xl font-semibold text-black mb-2 ml-1">Atencion!</h2>

        <ul class=" h-min max-h-64 overflow-y-auto p-5 max-w-sm md:max-w-none font-medium text-black">
            @foreach($vencidos as $item)
                <x-li-vencimiento :model="$item['model']" :camposVencidos="$item['camposVencidos']"/>
            @endforeach
        </ul>

    </aside>
    @endif

    <!--List of the menu-->
    @if(isset($list))
        <x-list :list="$list" :title="$title" :link="$link"></x-list>
    @else
        <x-options></x-options>
    @endif
</section>
@endsection
