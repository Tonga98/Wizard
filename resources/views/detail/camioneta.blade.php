@extends('layouts.myApp')

@section('content')
    <div class="h-full items-center flex justify-center ">
        <article class="rounded-lg w-3/5 shadow-3xl bg-white/60 m-5 p-5">
            <h1 class=" font-semibold text-3xl mb-5">{{$camioneta->patente}}</h1>

            <div class="flex justify-evenly">
                <ul class="mt-2">
                    <x-li :dato="$camioneta->ubicacion">{{"Ubicacion: "}}</x-li>
                    <x-li :dato="$camioneta->vtv_vencimiento" :date="true">{{"vtv_vencimiento: "}}</x-li>
                </ul>

            </div>
            <div class="flex items-center gap-2 justify-end mt-4">
                <a href="{{route('camioneta.edit',['camioneta'=>$camioneta->id])}}"
                   class="px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white hover:bg-gray-700">EDITAR
                    CAMIONETA</a>
                <form action="{{ route('camioneta.destroy', ['camioneta' => $camioneta->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="px-4 py-2 bg-red-800 rounded-md font-semibold text-xs text-white hover:bg-red-700">
                        ELIMINAR CAMIOENTA
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

