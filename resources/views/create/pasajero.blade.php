@extends('layouts.myApp')

@section('content')
    <div class="flex justify-center mx-4">
        <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
            <h2 class="font-semibold text-3xl tracking-wider">Añadir pasajero</h2>
            <form method="POST" action="{{ route('create.pasajero') }}" enctype="multipart/form-data" class="flex justify-between my-4">
                @csrf
                <!--Left side-->
                <div class="flex flex-col gap-3 mx-auto tracking-wide">

                    <!-- Name -->
                    <div>
                        <x-input-label for="nombre" :value="__('Nombre')" />
                        <x-text-input id="nombre" class="w-full" type="text" name="nombre" :value="old('nombre')" required autofocus autocomplete="nombre" />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>

                    <!-- Surname -->
                    <div>
                        <x-input-label for="apellido" :value="__('Apellido')" />
                        <x-text-input id="apellido" class="w-full" type="text" name="apellido" :value="old('apellido')" required autofocus autocomplete="apellido" />
                        <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
                    </div>

                    <!-- Ubicacion -->
                    <div>
                        <x-input-label for="ubicacion" :value="__('Ubicacion')" />
                        <x-text-input id="ubicacion" class="w-full" type="text" name="ubicacion" :value="old('ubicacion')" required autofocus autocomplete="ubicacion" />
                        <x-input-error :messages="$errors->get('ubicacion')" class="mt-2" />
                    </div>

                    <!-- num_telefono -->
                    <div>
                        <x-input-label for="num_telefono" :value="__('Celular')" />
                        <x-text-input id="num_telefono" class="w-full" type="number" name="num_telefono" :value="old('num_telefono')" required autofocus autocomplete="num_telefono" />
                        <x-input-error :messages="$errors->get('num_telefono')" class="mt-2" />
                    </div>

                    <!-- Camioneta -->
                    <div>
                        <x-input-label for="id_camioneta " :value="__('Camioneta')" />
                        <x-text-input id="id_camioneta " class="w-full" type="select" name="id_camioneta " :value="old('id_camioneta ')" required autocomplete="id_camioneta " />
                        <x-input-error :messages="$errors->get('id_camioneta ')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-4">
                            {{ __('Añadir pasajero') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
