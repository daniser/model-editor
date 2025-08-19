@use(function TTBooking\ModelEditor\Support\prop_val)

@aware(['object', 'editable'])
@props(['property'])

@if (! $object || ! $editable)
    <span {{ $attributes }} title="{{ prop_val($property, $object) }}" style="padding: 0 8px; border: 1px solid black; background-color: {{ prop_val($property, $object) }}"></span>
@else
    <input {{ $attributes }} type="color" name="{{ $property->variableName }}" value="{{ $object->{$property->variableName} }}" @readonly(! $property->writable) />
@endif
