@aware(['model'])
@props(['property'])

<input type="number" name="{{ $property->variableName }}" value="{{ $model->{$property->variableName} }}" @readonly(! $property->writable) />
