@aware(['object'])
@props(['property', 'default' => false])

@if ($default)
    <span {{ $attributes }} title="{{ $property->defaultValue }}" style="padding: 0 8px; border: 1px solid black; background-color: {{ $property->defaultValue }}"></span>
@else
    <input {{ $attributes }} type="color" name="{{ $property->variableName }}" value="{{ $object->{$property->variableName} }}" @readonly(! $property->writable) />
@endif
