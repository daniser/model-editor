@aware(['object'])
@props(['property', 'default' => false])

@if ($default)
    <span {{ $attributes }}>{{ __($property->defaultValue ? 'model-editor::form.on' : 'model-editor::form.off') }}</span>
@else
    <input {{ $attributes }} type="checkbox" name="{{ $property->variableName }}" @checked($object->{$property->variableName}) @disabled(! $property->writable) />
@endif
