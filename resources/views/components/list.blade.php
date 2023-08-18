@props(['list', 'title', 'link'])
<!--list se refiere a la lista la cual contiene todos los elementos de una tabla ej:(choferes, camionetas, ..etc)-->

<div class="w-3/12 border border-gray-500/50 shadow-2xl bg-slate-300/50 p-2">
    <h2 class="text-xl mb-2 ml-1">{{$title}}</h2>

    <div class="p-5 ">
        <ul class="font-medium text-base mb-2">
            <!--List se refiere a la lista de objetos del controlador que vino-->
            @foreach($list as $element)
                <!--$text para diferenciar si el list son camionetas al momento de listarlas no van a tener nombre y apellido-->
                @php($text = $element->patente ?? $element->nombre." ".$element->apellido)
                <li class="my-1">
                    <a href="{{ route($link.'.show',[$link=>$element->id]) }}" class="hover:cursor-pointer hover:underline">
                        {{$text. " - " .$element->ubicacion}}</a>
                </li>
            @endforeach
        </ul>
        <div class="mt-5">
            {{$list->links()}}
        </div>

    </div>

</div>

