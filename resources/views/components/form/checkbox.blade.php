@aware(['object'])
@props(['property'])

<input {{ $attributes }} type="checkbox" name="{{ $property->variableName }}" @checked($object->{$property->variableName}) @disabled(! $property->writable) />
