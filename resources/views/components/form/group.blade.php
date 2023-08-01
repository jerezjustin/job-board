@props(['name', 'label' => null, 'type' => 'text'])

<div {{ $attributes->merge(['class'=> 'form__group']) }}>
    @if($slot->isNotEmpty())
        {{ $slot }}
    @else
        <x-form.label :for="$name">
            {{ $label ?? ucfirst($name) }}
        </x-form.label>

        <x-form.input :name="$name" :id="$name" :type="$type" :value="old($name)"/>
    @endif

    @error($name)
        <span class="form__error">{{ $message }}</span>
    @enderror
</div>
