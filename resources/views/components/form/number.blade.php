@aware(['object'])
@props(['property'])

<input {{ $attributes }} type="number" name="{{ $property->variableName }}" value="{{ $object->{$property->variableName} }}" @readonly(! $property->writable) />
