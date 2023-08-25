@extends('layouts.myApp')

@section('content')
    <div class="h-full items-center flex justify-center">
        <article class="cardBlur m-5 p-5">
            <h1 class=" font-semibold text-3xl mb-5">{{$pasajero->nombre." ". $pasajero->apellido}}</h1>

            <div class="flex justify-evenly">
                <ul class="mt-2 font-medium text-black">
                    <x-li :dato="$pasajero->ubicacion">{{"Ubicacion: "}}</x-li>
                    <x-li :dato="$pasajero->num_telefono">{{"Celular: "}}</x-li>
                    <li class="mt-4 w-fit">{{"Camioneta: "}}<a href="{{route('camioneta.show',['camioneta'=>$camioneta->id])}}"
                                                               class="underline underline-offset-2">{{$camioneta->patente}}</a>
                    </li>
                </ul>

            </div>

            <div class="flex items-center gap-2 justify-end mt-4">

                {{--Button edit--}}
                <a href="{{route('pasajero.edit',['pasajero'=>$pasajero->id])}}"
                   class="px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white hover:bg-gray-700">EDITAR
                    PASAJERO</a>

                {{--Button delete--}}
                <form action="{{ route('pasajero.destroy', ['pasajero' => $pasajero->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="px-4 py-2 bg-red-800 rounded-md font-semibold text-xs text-white hover:bg-red-700">
                        ELIMINAR PASAJERO
                    </button>
                </form>

            </div>
        </article>
    </div>
@endsection

