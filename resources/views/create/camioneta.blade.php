@extends('layouts.myApp')

@section('content')
    <div class="flex justify-center mx-4">
        <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
            <h2 class="font-semibold text-3xl tracking-wider">Añadir camioneta</h2>
            <form method="POST" action="{{ route('create.camioneta') }}" enctype="multipart/form-data" class="flex justify-between my-4">
                @csrf
                <!--Inputs-->
                <div class="flex flex-col gap-2 mx-auto tracking-wide">

                    <!-- Patente -->
                    <div>
                        <x-input-label for="patente" :value="__('Patente')" />
                        <x-text-input id="patente" class="w-full" type="text" name="patente" :value="old('patente')"  autofocus autocomplete="patente" />
                        <x-input-error :messages="$errors->get('patente')" class="mt-2" />
                    </div>

                    <!-- Ubicacion -->
                    <div>
                        <x-input-label for="ubicacion" :value="__('Ubicacion')" />
                        <x-text-input id="ubicacion" class="w-full" type="text" name="ubicacion" :value="old('ubicacion')"  autocomplete="ubicacion" />
                        <x-input-error :messages="$errors->get('ubicacion')" class="mt-2" />
                    </div>

                    <!-- vtv_vencimiento -->
                    <div>
                        <x-input-label for="vtv_vencimiento " :value="__('vtv_vencimiento')" />
                        <x-text-input id="vtv_vencimiento " class="w-full" type="date" name="vtv_vencimiento " :value="old('vtv_vencimiento ')" required autocomplete="vtv_vencimiento " />
                        <x-input-error :messages="$errors->get('vtv_vencimiento ')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-4">
                            {{ __('Añadir camioneta') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
