@aware(['object'])
@props(['property'])

<input {{ $attributes }} type="text" name="{{ $property->variableName }}" value="{{ $object->{$property->variableName} }}" @readonly(! $property->writable) />
