@extends('layouts.myApp')

@section('content')
    <div class="h-full rounded-lg shadow-3xl bg-[#FFFFFF] m-5 p-5">
        <h1 class=" font-semibold text-3xl mb-5">{{$chofer->nombre." ". $chofer->apellido}}</h1>

        <div class="flex justify-evenly">
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
                <x-li :dato="$chofer->dni_frente">{{"DNI frente: "}}</x-li>
                <x-li :dato="$chofer->dni_dorso">{{"DNI dorso: "}}</x-li>
                <x-li :dato="$chofer->antecedentes_foto">{{"Antecedentes: "}}</x-li>
                <x-li :dato="$chofer->lic_conducir_frente">{{"Licencia frente: "}}</x-li>
                <x-li :dato="$chofer->lic_conducir_dorso">{{"Licencia dorso: "}}</x-li>
                <li class="mt-4 w-fit">{{"Camioneta: "}}<a href="" class="underline underline-offset-2">{{$camioneta->patente}}</a></li>
            </ul>
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Editar chofer') }}
            </x-primary-button>
        </div>
    </div>
@endsection
