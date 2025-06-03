<img src="{{ $preview }}" alt="{{ basename($model->{$property->variableName}) }}" title="{{ basename($model->{$property->variableName}) }}" />
<input {{ $attributes }}
    type="file"
    name="{{ $property->variableName }}"
    @isset($property->type->parameters[0])
    accept="{{ Str::unwrap($property->type->parameters[0], '"') }}"
    @endisset
    {!! $property->type->name === 'list' ? 'multiple' : '' !!}
    @readonly(! $property->writable)
/>
