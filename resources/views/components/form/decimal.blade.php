@aware(['object'])
@props(['property', 'default' => false])

@if ($default)
    <span {{ $attributes }}>{{ Number::format($property->defaultValue) }}</span>
@else
    <input {{ $attributes }} type="number" step="0.01" name="{{ $property->variableName }}" value="{{ $object->{$property->variableName} }}" @readonly(! $property->writable) />
@endif
