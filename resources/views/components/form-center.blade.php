@props(['chofer', 'edit'])

<div class="flex flex-col gap-2 mx-auto tracking-wide">

    <!-- Antecedentes_foto -->
    <div>
        <x-input-label for="antecedentes_foto" :value="__('Antecedentes foto')" />
        <x-text-input id="antecedentes_foto" class="w-full" type="file" name="antecedentes_foto" :value="$edit ? $chofer->antecedentes_foto : old('antecedentes_foto')" autofocus autocomplete="antecedentes_foto" />
        <x-input-error :messages="$errors->get('antecedentes_foto')" class="mt-2" />
    </div>

    <!-- Antecedentes Vencimiento -->
    <div>
        <x-input-label for="antecedentes_venc" :value="__('Vencimiento antecedentes')" />
        <x-text-input id="antecedentes_venc" class="w-full" type="date" name="antecedentes_venc" :value="$edit ? $chofer->antecedentes_venc : old('antecedentes_venc')" required autofocus autocomplete="antecedentes_venc" />
        <x-input-error :messages="$errors->get('antecedentes_venc')" class="mt-2" />
    </div>

    <!-- Lic. conducir vencimiento -->
    <div>
        <x-input-label for="lic_conducir_venc" :value="__('Vencimiento lic.conducir')" />
        <x-text-input id="lic_conducir_venc" class="w-full" type="date" name="lic_conducir_venc" :value="$edit ? $chofer->lic_conducir_venc : old('lic_conducir_venc')" required autofocus autocomplete="lic_conducir_venc" />
        <x-input-error :messages="$errors->get('lic_conducir_venc')" class="mt-2" />
    </div>

    <!-- lic_conducir_frente -->
    <div>
        <x-input-label for="lic_conducir_frente" :value="__('Lic.Conducir frente')" />
        <x-text-input id="lic_conducir_frente" class="w-full" type="file" name="lic_conducir_frente" :value="$edit ? $chofer->lic_conducir_frente : old('lic_conducir_frente')"  autofocus autocomplete="lic_conducir_frente" />
        <x-input-error :messages="$errors->get('lic_conducir_frente')" class="mt-2" />
    </div>

    <!-- lic_conducir_dorso -->
    <div>
        <x-input-label for="lic_conducir_dorso" :value="__('Lic.Conducir dorso')" />
        <x-text-input id="lic_conducir_dorso" class="w-full" type="file" name="lic_conducir_dorso" :value="$edit ? $chofer->lic_conducir_dorso : old('lic_conducir_dorso')"  autofocus autocomplete="lic_conducir_dorso" />
        <x-input-error :messages="$errors->get('lic_conducir_dorso')" class="mt-2" />
    </div>

    <!-- Vencimiento LINTI -->
    <div>
        <x-input-label for="linti_venc" :value="__('Vencimiento LINTI')" />
        <x-text-input id="linti_venc" class="w-full" type="date" name="linti_venc" :value="$edit ? $chofer->linti_venc : old('linti_venc')" required autocomplete="linti_venc" />
        <x-input-error :messages="$errors->get('linti_venc')" class="mt-2" />
    </div>

</div>
