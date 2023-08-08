@props(['list', 'title'])


<div class="mx-auto mt-8 md:mt-14 min-w-min h-min card">
    <h2 class="text-xl mb-2 ml-1">{{$title}}</h2>

    <div class="h-min p-5 max-w-sm md:max-w-none">
        <!--List se refiere a la lista de objetos del controlador que vino-->
        @foreach($list as $element)
            @php($text = $element->patente ?? $element->nombre." ".$element->apellido)
            <ul class="font-medium text-base">
                <li><a href="{{ route('chofer.show',['chofer'=>$element->id]) }}" class="hover:cursor-pointer hover:underline">{{$text. " - " .$element->ubicacion}}</a></li>
            </ul>
        @endforeach
    </div>

</div>

