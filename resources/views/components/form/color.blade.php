@aware(['model'])
@props(['property'])

<input {{ $attributes }} type="color" name="{{ $property->variableName }}" value="{{ $model->{$property->variableName} }}" @readonly(! $property->writable) />
