@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border border-slate-400 p-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
