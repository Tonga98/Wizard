@props(['list'])


<div class="mx-auto mt-8 md:mt-14 min-w-min h-min card">
    <h2 class="text-xl mb-2 ml-1">Choferes</h2>

    <div class="h-min p-5 max-w-sm md:max-w-none">
        @foreach($list as $element)
            <ul class="font-medium text-base">
                <li ><a href="" class="hover:cursor-pointer hover:underline">{{$element}}</a></li>
            </ul>
        @endforeach
    </div>

</div>

