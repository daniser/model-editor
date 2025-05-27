@aware(['model'])
@props(['property'])

<input type="file" name="{{ $property->variableName }}" value="{{ $model->{$property->variableName} }}" {!! $property->type->name === 'list' ? 'multiple' : '' !!} @readonly(! $property->writable) />
