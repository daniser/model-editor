@use(function TTBooking\ModelEditor\Support\prop_val)

@aware(['object', 'editable'])
@props(['property'])

@if (! $object || ! $editable)
    <span {{ $attributes }}>{{ Number::format(prop_val($property, $object)) }}</span>
@else
    <input {{ $attributes }} type="number" step="0.01" name="{{ $property->variableName }}" value="{{ $object->{$property->variableName} }}" @readonly(! $property->writable) />
@endif
