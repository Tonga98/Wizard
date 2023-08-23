@extends('layouts.myApp')

@section('content')
    <div class="h-full items-center flex justify-center">
        <article class="w-3/5 m-5 p-5 cardBlur">
            <h1 class=" font-semibold text-3xl mb-5">{{$guarda->nombre." ". $guarda->apellido}}</h1>

            <div class="flex justify-evenly font-medium text-black">
                <ul class="mt-2">
                    <x-li :dato="$guarda->dni_num">{{"DNI: "}}</x-li>
                    <x-li :dato="$guarda->email">{{"Email: "}}</x-li>
                    <x-li :dato="$guarda->ubicacion">{{"Ubicacion: "}}</x-li>
                    <x-li :dato="$guarda->num_telefono">{{"Celular: "}}</x-li>
                    <x-li :dato="$guarda->antecedentes_venc" :date="true">{{"Vencimiento antecedentes: "}}</x-li>
                </ul>

                <ul class="mt-2">
                    <x-li :dato="$guarda->dni_frente" :file="true" campo="dni_frente" model="guarda">{{"DNI frente: "}}</x-li>
                    <x-li :dato="$guarda->dni_dorso" :file="true" campo="dni_dorso" model="guarda">{{"DNI dorso: "}}</x-li>
                    <x-li :dato="$guarda->antecedentes_foto" :file="true" campo="antecedentes_foto" model="guarda">{{"Antecedentes: "}}</x-li>
                    <li class="mt-4 w-fit">{{"Camioneta: "}}<a href="{{route('camioneta.show',['camioneta'=>$camioneta->id])}}"
                                                               class="underline underline-offset-2">{{$camioneta->patente}}</a>
                    </li>
                </ul>
            </div>
            <div class="flex items-center gap-2 justify-end mt-4">
                <a href="{{route('guarda.edit',['guarda'=>$guarda->id])}}"
                   class="px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white hover:bg-gray-700">EDITAR
                    GUARDA</a>
                <form action="{{ route('guarda.destroy', ['guarda' => $guarda->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="px-4 py-2 bg-red-800 rounded-md font-semibold text-xs text-white hover:bg-red-700">
                        ELIMINAR GUARDA
                    </button>
                </form>
            </div>
        </article>
    </div>
@endsection

