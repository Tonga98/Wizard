@extends('layouts.myApp')

@section('content')
    <div class="flex justify-center mx-4">
        <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
            <h2 class="font-semibold text-3xl tracking-wider">Añadir guarda</h2>
            <form method="POST" action="{{ route('create.guarda') }}" enctype="multipart/form-data" class="flex justify-between my-4">
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

                    <!-- DNI -->
                    <div>
                        <x-input-label for="dni_num" :value="__('DNI')" />
                        <x-text-input id="dni_num" class="w-full" type="number" name="dni_num" :value="old('dni_num')" required autofocus autocomplete="dni_num" />
                        <x-input-error :messages="$errors->get('dni_num')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
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


                </div>

                <!--Center-->
                <div class="flex flex-col gap-2 mx-auto tracking-wide">

                    <!-- Antecedentes_foto -->
                    <div>
                        <x-input-label for="antecedentes_foto" :value="__('Antecedentes foto')" />
                        <x-text-input id="antecedentes_foto" class="w-full" type="file" name="name" :value="old('antecedentes_foto')" autofocus autocomplete="antecedentes_foto" />
                        <x-input-error :messages="$errors->get('antecedentes_foto')" class="mt-2" />
                    </div>

                    <!-- Antecedentes Vencimiento -->
                    <div>
                        <x-input-label for="antecedentes_venc" :value="__('Vencimiento antecedentes')" />
                        <x-text-input id="antecedentes_venc" class="w-full" type="date" name="antecedentes_venc" :value="old('antecedentes_venc')" required autofocus autocomplete="antecedentes_venc" />
                        <x-input-error :messages="$errors->get('antecedentes_venc')" class="mt-2" />
                    </div>


                </div>

                <!---Right side-->
                <div class="flex flex-col gap-2 mx-auto tracking-wide">

                    <!-- Foto dni frente -->
                    <div>
                        <x-input-label for="dni_frente" :value="__('Imagen dni frente')" />
                        <x-text-input id="dni_frente" class="w-full" type="file" name="dni_frente" :value="old('dni_frente')"  autofocus autocomplete="dni_frente" />
                        <x-input-error :messages="$errors->get('dni_frente')" class="mt-2" />
                    </div>

                    <!-- Foto dni dorso -->
                    <div>
                        <x-input-label for="dni_dorso" :value="__('Imagen dni dorso')" />
                        <x-text-input id="dni_dorso" class="w-full" type="file" name="dni_dorso" :value="old('dni_dorso')"  autocomplete="dni_dorso" />
                        <x-input-error :messages="$errors->get('dni_dorso')" class="mt-2" />
                    </div>

                    <!-- Camioneta -->
                    <div>
                        <x-input-label for="id_camioneta " :value="__('Camioneta')" />
                        <x-text-input id="id_camioneta " class="w-full" type="select" name="id_camioneta " :value="old('id_camioneta ')" required autocomplete="id_camioneta " />
                        <x-input-error :messages="$errors->get('id_camioneta ')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="w-full"
                                      type="password"
                                      name="password"
                                      required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="w-full"
                                      type="password"
                                      name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-4">
                            {{ __('Añadir guarda') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
