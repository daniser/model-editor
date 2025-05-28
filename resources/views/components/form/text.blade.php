@aware(['model'])
@props(['property'])

<input {{ $attributes }} type="text" name="{{ $property->variableName }}" value="{{ $model->{$property->variableName} }}" @readonly(! $property->writable) />
