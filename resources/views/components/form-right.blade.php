@props(['model', 'edit', 'camionetas'])

<div class="flex flex-col gap-2 mx-auto tracking-wide">

    <!-- Foto dni frente -->
    <div>
        <x-input-label for="dni_frente" :value="__('Imagen dni frente')" />
        <x-text-input id="dni_frente" class="w-full" type="file" name="dni_frente" :value="$edit ? $model->dni_frente : old('dni_frente')"  autofocus autocomplete="dni_frente" />
        <x-input-error :messages="$errors->get('dni_frente')" class="mt-2" />
    </div>

    <!-- Foto dni dorso -->
    <div>
        <x-input-label for="dni_dorso" :value="__('Imagen dni dorso')" />
        <x-text-input id="dni_dorso" class="w-full" type="file" name="dni_dorso" :value="$edit ? $model->dni_dorso : old('dni_dorso')"  autocomplete="dni_dorso" />
        <x-input-error :messages="$errors->get('dni_dorso')" class="mt-2" />
    </div>

    <!-- Camioneta -->
    <div>
        <x-input-label for="id_camioneta " :value="__('Camioneta')" />
        <select id="id_camioneta" name="id_camioneta" class="w-full">
            @foreach($camionetas as $camioneta)
                <option value="{{ $camioneta->id }}">{{ $camioneta->patente }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('id_camioneta ')" class="mt-2" />
    </div>

    <!-- Password -->
    <div>
        <x-input-label for="password" :value="__('Contraseña')" />

        <x-text-input id="password" class="w-full"
                      type="password"
                      name="password"
                      autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div>
        <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

        <x-text-input id="password_confirmation" class="w-full"
                      type="password"
                      name="password_confirmation"
                      autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>
    {{$slot}}
</div>
