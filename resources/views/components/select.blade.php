@props(['disabled' => false, 'options' => []])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes !!}>
    <option>{{ __('Please choose an option') }}</option>
    @foreach ($options as $key => $value)
        <option wire:key="option-{{ $key }}" value="{{ $value }}">{{ $value }}</option>
    @endforeach
</select>