@aware(['model'])
@props(['property'])

<input type="checkbox" name="{{ $property->variableName }}" @checked($model->{$property->variableName}) @disabled(! $property->writable) />
