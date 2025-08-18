@aware(['object'])
@props(['property', 'default' => false])

@if ($default)
    <span {{ $attributes }}>{{ $property->defaultValue }}</span>
@else
    <input {{ $attributes }} type="text" name="{{ $property->variableName }}" value="{{ $object->{$property->variableName} }}" @readonly(! $property->writable) />
@endif
