@props(['dato', 'date'=>false, 'file'=>false])

{{-- dato: Se refiere al dato obtenido del chofer que se debe mostrar--}}
{{-- date: Se refiere a si el tipo de dato que se debe mostrar es una fecha, entonces vendra con true--}}
{{-- file: Se refiere a si el tipo de dato que se debe mostrar es un file entonces vendra con true--}}


@if(empty($dato))
    <li class="mt-4 w-fit" >{{$slot." "}}<span class="bg-red-500 rounded-md  p-1"> No cargado!</span></li>
@else

    @if($date)
        @php ($formattedDate = date('d-m-Y', strtotime($dato)))
        <li class="mt-4 w-fit">{{$slot." ".$formattedDate}}</li>
    @elseif($file)
        <li class="mt-4 w-fit">{{$slot." "}}<a href="" class="underline underline-offset-2">Descargar</a></li>
    @else
        <li class="mt-4 w-fit">{{$slot." ".$dato}}</li>
    @endif

@endif
