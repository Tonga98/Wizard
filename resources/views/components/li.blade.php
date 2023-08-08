@props(['dato', 'date'=>false])

@if(empty($dato))
    <li class="mt-4 w-fit" >{{$slot." "}}<span class="bg-red-500 rounded-md  p-1"> No cargado!</span></li>
@else

    @if($date)
        @php ($formattedDate = date('d-m-Y', strtotime($dato)))
        <li class="mt-4 w-fit">{{$slot." ".$formattedDate}}</li>
    @else
        <li class="mt-4 w-fit">{{$slot." ".$dato}}</li>
    @endif

@endif
