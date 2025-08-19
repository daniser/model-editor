@use(function TTBooking\ModelEditor\Support\prop_val)

@aware(['object', 'editable'])
@props(['property'])

@if (! $object || ! $editable)
    <span {{ $attributes }}>{{ __(prop_val($property, $object) ? 'model-editor::form.on' : 'model-editor::form.off') }}</span>
@else
    <input {{ $attributes }} type="checkbox" name="{{ $property->variableName }}" @checked($object->{$property->variableName}) @disabled(! $property->writable) />
@endif
