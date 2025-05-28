@aware(['model'])
@props(['property'])

<input {{ $attributes }} type="number" name="{{ $property->variableName }}" value="{{ $model->{$property->variableName} }}" @readonly(! $property->writable) />
