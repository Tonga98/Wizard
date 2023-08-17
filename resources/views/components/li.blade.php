@props(['dato', 'date'=>false, 'file'=>false, 'campo','model'=>'chofer'])

{{-- dato: Se refiere al dato obtenido del chofer que se debe mostrar--}}
{{-- date: Se refiere a si el tipo de dato que se debe mostrar es una fecha, entonces vendra con true--}}
{{-- file: Se refiere a si el tipo de dato que se debe mostrar es un file entonces vendra con true--}}
{{-- model: Se refiere a si el modelo es chofer o guarda para luego ir a su corresponiente ruta,
     Si es un chofer entonces model es chofer, si es una guarda entonces model vendra con valor = guarda--}}



@if(empty($dato)) {{--Si no tiene cargado el dato--}}
    <li class="mt-4 w-fit" >{{$slot." "}}<span class="bg-red-500 rounded-md  p-1"> No cargado!</span></li>
@else {{--Tiene cargado el dato--}}


    @if($date) {{--Si el dato es tipo fecha--}}

        @php ($formattedDate = date('d-m-Y', strtotime($dato)))
        <li class="mt-4 w-fit">{{$slot." ".$formattedDate}}</li>

    @elseif($file) {{--Si el dato es un file--}}

        @if($model == 'chofer') {{--Si el file es del modelo chofer --}}

            <li class="mt-4 w-fit flex items-center">{{$slot." "}}
                <a href="{{Storage::url('choferes/'.$dato)}}" download> <img class="ml-2 w-8" src="{{asset("img/download.svg")}}"> </a>
                <a href="{{route('eliminar.archivo.chofer',['archivo'=>$dato, 'campo'=>$campo])}}"> <img class="ml-2 w-8" src="{{asset("img/trash.svg")}}"> </a>
            </li>

        @else   {{--Si el file es del modelo guarda --}}

            <li class="mt-4 w-fit flex items-center">{{$slot." "}}
                <a href="{{Storage::url('guardas/'.$dato)}}" download> <img class="ml-2 w-8" src="{{asset("img/download.svg")}}"> </a>
                <a href="{{route('eliminar.archivo.guarda',['archivo'=>$dato, 'campo'=>$campo])}}"> <img class="ml-2 w-8" src="{{asset("img/trash.svg")}}"> </a>
            </li>

        @endif

    @else {{--Si el dato es un string --}}
        <li class="mt-4 w-fit">{{$slot." ".$dato}}</li>
    @endif

@endif
