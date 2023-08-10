@extends('layouts.myApp')

@section('content')
    <div class="flex justify-center">
        <div class="rounded-lg w-3/5 shadow-3xl bg-[#FFFFFF] m-5 p-5">
            <h1 class=" font-semibold text-3xl mb-5">{{$pasajero->nombre." ". $pasajero->apellido}}</h1>

            <div class="flex justify-evenly">
                <ul class="mt-2">
                    <x-li :dato="$pasajero->ubicacion">{{"Ubicacion: "}}</x-li>
                    <x-li :dato="$pasajero->num_telefono">{{"Celular: "}}</x-li>
                </ul>

                <ul class="mt-2">
                    <li class="mt-4 w-fit">{{"Camioneta: "}}<a href=""
                                                               class="underline underline-offset-2">{{$camioneta->patente}}</a>
                    </li>
                </ul>
            </div>
            <div class="flex items-center justify-end mt-4">
                <a href="{{route('pasajero.edit',['pasajero'=>$pasajero->id])}}"
                   class="px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white hover:bg-gray-700">EDITAR
                    PASAJERO</a>
            </div>
        </div>
    </div>
@endsection

