@aware(['object'])
@props(['property'])

<input {{ $attributes }} type="number" step="0.01" name="{{ $property->variableName }}" value="{{ $object->{$property->variableName} }}" @readonly(! $property->writable) />
