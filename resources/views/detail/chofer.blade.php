@extends('layouts.myApp')

@section('content')
    <div class=" h-full flex justify-center items-center">
        <article class="w-3/5 shadow-3xl m-5 p-5 cardBlur">
            <h1 class=" font-semibold text-3xl mb-5">{{$chofer->nombre." ". $chofer->apellido}}</h1>

            <div class="flex justify-evenly font-medium text-black">
                <ul class="mt-2">
                    <x-li :dato="$chofer->dni_num">{{"DNI: "}}</x-li>
                    <x-li :dato="$chofer->email">{{"Email: "}}</x-li>
                    <x-li :dato="$chofer->ubicacion">{{"Ubicacion: "}}</x-li>
                    <x-li :dato="$chofer->num_telefono">{{"Celular: "}}</x-li>
                    <x-li :dato="$chofer->lic_conducir_venc" :date="true">{{"Vencimiento Lic. Conducir: "}}</x-li>
                    <x-li :dato="$chofer->linti_venc" :date="true">{{"Vencimiento Linti: "}}</x-li>
                    <x-li :dato="$chofer->antecedentes_venc" :date="true">{{"Vencimiento antecedentes: "}}</x-li>
                </ul>

                <ul class="mt-2">
                    <x-li :dato="$chofer->dni_frente" :file="true" campo="dni_frente">{{"DNI frente: "}}</x-li>
                    <x-li :dato="$chofer->dni_dorso" :file="true" campo="dni_dorso">{{"DNI dorso: "}}</x-li>
                    <x-li :dato="$chofer->antecedentes_foto" :file="true" campo="antecedentes_foto">{{"Antecedentes: "}}</x-li>
                    <x-li :dato="$chofer->lic_conducir_frente" :file="true" campo="lic_conducir_frente">{{"Licencia frente: "}}</x-li>
                    <x-li :dato="$chofer->lic_conducir_dorso" :file="true" campo="lic_conducir_dorso">{{"Licencia dorso: "}}</x-li>
                    <li class="mt-4 w-fit">{{"Camioneta: "}}<a href="{{route('camioneta.show',['camioneta'=>$camioneta->id])}}"
                                                               class="underline underline-offset-2">{{$camioneta->patente}}</a>
                    </li>
                </ul>
            </div>
            <div class="flex items-center gap-2 justify-end mt-4">
                <a href="{{route('chofer.edit',['chofer'=>$chofer->id])}}"
                   class="px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white hover:bg-gray-700">EDITAR
                    CHOFER</a>

                <form action="{{ route('chofer.destroy', ['chofer' => $chofer->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="px-4 py-2 bg-red-800 rounded-md font-semibold text-xs text-white hover:bg-red-700">
                        ELIMINAR CHOFER
                    </button>
                </form>

            </div>
        </article>
    </div>
@endsection
