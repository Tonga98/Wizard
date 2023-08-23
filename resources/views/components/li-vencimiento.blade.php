@props(['model', 'camposVencidos'])

@foreach($camposVencidos as $campo => $fecha)

    @php
        $link = $model instanceof \App\Models\Chofer ? 'chofer' : ($model instanceof \App\Models\Guarda ? 'guarda' : 'camioneta');
    @endphp


    <li>
        <a href="{{route($link.'.show',[$link=>$model->id])}}" class="hover:cursor-pointer hover:underline">
            - Próximo vencimiento ({{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}): {{$campo}}  {{$model->nombre." ". $model->apellido}} </a>
    </li>
@endforeach
