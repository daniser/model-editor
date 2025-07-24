@aware(['model'])
@props(['property'])

<input {{ $attributes }} type="number" step="0.01" name="{{ $property->variableName }}" value="{{ $model->{$property->variableName} }}" @readonly(! $property->writable) />
