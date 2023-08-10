@extends('layouts.myApp')

@section('content')
    <div class="flex justify-center">
        <div class="rounded-lg w-3/5 shadow-3xl bg-[#FFFFFF] m-5 p-5">
            <h1 class=" font-semibold text-3xl mb-5">{{$camioneta->patente}}</h1>

            <div class="flex justify-evenly">
                <ul class="mt-2">
                    <x-li :dato="$camioneta->ubicacion">{{"Ubicacion: "}}</x-li>
                    <x-li :dato="$camioneta->vtv_vencimiento" :date="true">{{"vtv_vencimiento: "}}</x-li>
                </ul>

            </div>
            <div class="flex items-center justify-end mt-4">
                <a href="{{route('camioneta.edit',['camioneta'=>$camioneta->id])}}"
                   class="px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white hover:bg-gray-700">EDITAR
                    CAMIONETA</a>
            </div>
        </div>
    </div>
@endsection

