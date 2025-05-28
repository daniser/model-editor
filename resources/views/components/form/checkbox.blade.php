@aware(['model'])
@props(['property'])

<input {{ $attributes }} type="checkbox" name="{{ $property->variableName }}" @checked($model->{$property->variableName}) @disabled(! $property->writable) />
