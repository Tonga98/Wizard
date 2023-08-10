@props(['list', 'title', 'link'])
<!--list se refiere a la lista la cual contiene todos los elementos de una tabla ej:(choferes, camionetas, ..etc)-->

<div class="mx-auto mt-8 md:mt-14 min-w-min h-min card">
    <h2 class="text-xl mb-2 ml-1">{{$title}}</h2>

    <div class="h-min p-5 max-w-sm md:max-w-none">
        <!--List se refiere a la lista de objetos del controlador que vino-->
        @foreach($list as $element)

            <!--$text para diferenciar si el list son camionetas al momento de listarlas no van a tener nombre y apellido-->
            @php($text = $element->patente ?? $element->nombre." ".$element->apellido)
            <ul class="font-medium text-base">
                <li><a href="{{ route($link.'.show',[$link=>$element->id]) }}" class="hover:cursor-pointer hover:underline">{{$text. " - " .$element->ubicacion}}</a></li>
            </ul>
        @endforeach
    </div>

</div>

