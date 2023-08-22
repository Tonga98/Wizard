@extends('layouts.myApp')

@section('content')

    <!--Si vengo desde el controlador de edit, $edit=true-->
@if(!isset($edit))
    {{$edit=false}}
@endif

    <div class="flex justify-center mx-4">
        <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
            <h2 class="font-semibold text-3xl tracking-wider">{{$edit ? 'Editar guarda':'Añadir guarda'}}</h2>
            <form method="POST" action="{{ $edit ? route('guarda.update',['guarda'=>$guarda]) :route('guarda.store') }}" enctype="multipart/form-data" class="flex justify-between my-4">
                @csrf

                @if($edit)
                    @method('PATCH')
                @endif
                <!--Left side-->
                <x-form-left :edit="$edit" :model="$guarda ?? ''" />

                <!--Center-->
                <div class="flex flex-col gap-2 mx-auto tracking-wide">

                    <!-- Antecedentes_foto -->
                    <div>
                        <x-input-label for="antecedentes_foto" :value="__('Antecedentes foto')" />
                        <x-text-input id="antecedentes_foto" class="w-full" type="file" name="antecedentes_foto" :value="$edit ? $guarda->antecedentes_foto : old('antecedentes_foto')" autofocus autocomplete="antecedentes_foto" />
                        <x-input-error :messages="$errors->get('antecedentes_foto')" class="mt-2" />
                    </div>

                    <!-- Antecedentes Vencimiento -->
                    <div>
                        <x-input-label for="antecedentes_venc" :value="__('Vencimiento antecedentes')" />
                        <x-text-input id="antecedentes_venc" class="w-full" type="date" name="antecedentes_venc" :value="$edit ? $guarda->antecedentes_venc : old('antecedentes_venc')" required autofocus autocomplete="antecedentes_venc" />
                        <x-input-error :messages="$errors->get('antecedentes_venc')" class="mt-2" />
                    </div>


                </div>

                <!---Right side-->
                <x-form-right :edit="$edit" :model="$guarda ?? ''" :camionetas="$camionetas">
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-4">
                            {{ $edit ? 'Guardar cambios' : 'Añadir guarda' }}
                        </x-primary-button>
                    </div>
                </x-form-right>

            </form>
        </div>
    </div>
@endsection
