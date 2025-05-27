@aware(['model'])
@props(['property'])

<input type="text" name="{{ $property->variableName }}" value="{{ $model->{$property->variableName} }}" @readonly(! $property->writable) />
