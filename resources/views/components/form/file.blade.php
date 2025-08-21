@use(function TTBooking\ModelEditor\Support\prop_val)

@aware(['object', 'action', 'editable'])
@props(['property'])

@if ($action)
    <a {{ $attributes }} href="{{ $action.'/'.$property->variableName }}">{{ prop_val($property, $object) }}</a>
@else
    <span {{ $attributes }}>{{ prop_val($property, $object) }}</span>
@endif

@if ($object && $editable)
    <input {{ $attributes }}
        type="file"
        name="{{ $property->variableName }}"
        @isset($property->type->parameters[0])
        accept="{{ Str::unwrap($property->type->parameters[0], '"') }}"
        @endisset
        {!! $property->type->name === 'list' ? 'multiple' : '' !!}
        @readonly(! $property->writable)
    />
@endif
