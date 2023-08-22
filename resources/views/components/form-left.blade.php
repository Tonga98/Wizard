@props(['model', 'edit'])

<div class="flex flex-col gap-3 mx-auto tracking-wide"  >

    <!-- Name -->
    <div>
        <x-input-label for="nombre" :value="__('Nombre')" />
        <x-text-input id="nombre" class="w-full" type="text" name="nombre" :value="$edit ? $model->nombre : old('nombre')" placeholder="Nombre..." required autofocus autocomplete="nombre"/>
        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
    </div>

    <!-- Surname -->
    <div>
        <x-input-label for="apellido" :value="__('Apellido')" />
        <x-text-input id="apellido" class="w-full" type="text" name="apellido" :value="$edit ? $model->apellido : old('apellido')" placeholder="Apellido..." required autofocus autocomplete="apellido" />
        <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
    </div>

    <!-- DNI -->
    <div>
        <x-input-label for="dni_num" :value="__('DNI')" />
        <x-text-input id="dni_num" class="w-full" type="number" name="dni_num" :value="$edit ? $model->dni_num : old('dni_num')" placeholder="DNI..." required autofocus autocomplete="dni_num" />
        <x-input-error :messages="$errors->get('dni_num')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="w-full" type="email" name="email" :value="$edit ? $model->email : old('email')" placeholder="Email..." required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Ubicacion -->
    <div>
        <x-input-label for="ubicacion" :value="__('Ubicacion')" />
        <x-text-input id="ubicacion" class="w-full" type="text" name="ubicacion" :value="$edit ? $model->ubicacion : old('ubicacion')" placeholder="Ubicacion..." required autofocus autocomplete="ubicacion" />
        <x-input-error :messages="$errors->get('ubicacion')" class="mt-2" />
    </div>

    <!-- num_telefono -->
    <div>
        <x-input-label for="num_telefono" :value="__('Celular')" />
        <x-text-input id="num_telefono" class="w-full" type="number" name="num_telefono" :value="$edit ? $model->num_telefono : old('num_telefono')" placeholder="Celular..." required autofocus autocomplete="num_telefono" />
        <x-input-error :messages="$errors->get('num_telefono')" class="mt-2" />
    </div>


</div>
