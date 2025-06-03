@aware(['model'])
@props(['property'])

<input {{ $attributes }}
    type="file"
    name="{{ $property->variableName }}"
    @isset($property->type->parameters[0])
    accept="{{ Str::unwrap($property->type->parameters[0], '"') }}"
    @endisset
    {!! $property->type->name === 'list' ? 'multiple' : '' !!}
    @readonly(! $property->writable)
/>
