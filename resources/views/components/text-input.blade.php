@props(['disabled' => false, 'require' => false])

<input {{ $disabled ? 'disabled' : '' }} {{$require ? 'require' : ''}} {!! $attributes->merge(['class' => 'border border-slate-400 p-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
