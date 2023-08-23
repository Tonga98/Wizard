@props(['list', 'title', 'link'])
<!--list se refiere a la lista la cual contiene todos los elementos de una tabla ej:(choferes, camionetas, ..etc)-->
<aside class="w-3/12 border border-gray-500/50 p-2 cardBlur">
    <h2 class="text-2xl font-semibold text-black mb-3 ml-1">{{$title}}</h2>

    <!-- Agregar un formulario de búsqueda -->
    <form action="{{ route($link.'.search') }}" method="POST" class="pl-4 flex items-center">
        @csrf

        <input type="text" name="search" placeholder="Buscar por nombre o ubicación"
               class="w-4/5 p-1 border rounded-md focus:outline-none" required>

        <button type="submit"><img src="{{asset("img/search.svg")}}" class="w-7 ml-2" alt="Lupa" title="Buscar"></button>
    </form>

        @if(count($list) > 0)
            <ul class="max-h-80 overflow-y-auto font-medium text-black font-medium px-4 pt-1">
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
                @if(count($list) >= 10 || (isset($_GET['page']) && $_GET['page'] != 1))
                    <div class="mt-5">
                        {{--$list->links()--}}
                    </div>
                @endif
        @else
        <p class="font-medium text-base text-center p-4">Sin resultados!</p>
        @endif

</aside>

