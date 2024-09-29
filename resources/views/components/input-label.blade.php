@props(['value'])

<label {{ $attributes }} class="block mb-2">
    {{ $value ?? $slot }}
</label>