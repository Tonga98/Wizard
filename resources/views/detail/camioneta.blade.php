@extends('layouts.myApp')

@section('content')
    <div class="h-full items-center flex justify-center ">
        <article class="m-5 p-5 cardBlur">

            <h1 class=" font-semibold text-3xl mb-5 h-fit">{{$camioneta->patente}}</h1>
            <div class="flex justify-evenly">

                <ul class="mt-2 font-medium text-black">
                    @if(!empty($chofer))
                        <li class="mt-4 w-fit hover:underline"><a
                                href="{{route('chofer.show',['chofer'=>$chofer->id])}}">{{"Chofer: ".$chofer->nombre." ".$chofer->apellido}}</a>
                        </li>
                    @else
                        <li class="mt-4 w-fit">{{"Chofer: "}}<span
                                class="bg-red-500 rounded-md  p-1"> No cargado!</span></li>
                    @endif

                    @if(!empty($guarda))
                        <li class="mt-4 w-fit hover:underline"><a
                                href="{{route('guarda.show',['guarda'=>$guarda->id])}}">{{"Guarda: ".$guarda->nombre." ".$guarda->apellido}}</a>
                        </li>
                    @else
                        <li class="mt-4 w-fit">{{"Guarda: "}}<span
                                class="bg-red-500 rounded-md  p-1"> No cargado!</span></li>
                    @endif
                    <x-li :dato="$camioneta->ubicacion">{{"Ubicacion: "}}</x-li>
                    <x-li :dato="$camioneta->vtv_vencimiento" :date="true">{{"vtv_vencimiento: "}}</x-li>
                </ul>

            </div>

            <div class="flex items-center gap-2 justify-end mt-4">

                {{--Button edit--}}
                <a href="{{route('camioneta.edit',['camioneta'=>$camioneta->id])}}"
                   class="px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white hover:bg-gray-700">EDITAR
                    CAMIONETA</a>

                {{--Button delete --}}
                <form action="{{ route('camioneta.destroy', ['camioneta' => $camioneta->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="px-4 py-2 bg-red-800 rounded-md font-semibold text-xs text-white hover:bg-red-700">
                        ELIMINAR CAMIONETA
                    </button>
                </form>
            </div>
        </article>
        <x-list :list="$list" title="Pasajeros" link="pasajero" :search="false"></x-list>
    </div>
@endsection

