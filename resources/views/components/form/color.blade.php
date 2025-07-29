@aware(['object'])
@props(['property'])

<input {{ $attributes }} type="color" name="{{ $property->variableName }}" value="{{ $object->{$property->variableName} }}" @readonly(! $property->writable) />
