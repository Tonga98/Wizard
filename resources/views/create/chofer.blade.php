@extends('layouts.myApp')

@section('content')

    <!--Si vengo desde el controlador de edit, $edit=true-->
    @if(!isset($edit))
        {{$edit=false}}
    @endif

    <div class="flex justify-center mx-4">
        <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
            <h2 class="font-semibold text-3xl tracking-wider">{{$edit ? 'Editar chofer' : 'Añadir chofer' }}</h2>
            <form method="POST" action="{{ $edit ? route('chofer.update',['chofer'=>$chofer]) : route('chofer.store')}}" enctype="multipart/form-data" class="flex justify-between my-4">
                @csrf

                @if($edit)
                    @method('PATCH')
                @endif

                <!--Left side-->
                <x-form-left :edit="$edit" :model="$chofer ?? ''" />

                <!--Center-->
                <x-form-center :edit="$edit" :chofer="$chofer ?? ''" />

                <!--Right side-->
                <x-form-right :edit="$edit" :model="$chofer ?? ''" :camionetas="$camionetas">
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-4">
                            {{ $edit ? 'Guardar cambios' : 'Añadir chofer' }}
                        </x-primary-button>
                    </div>
                </x-form-right>

            </form>
        </div>
    </div>
@endsection
