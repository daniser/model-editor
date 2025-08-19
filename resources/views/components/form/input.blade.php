@aware(['alias', 'editable'])

@if (! $object && ! $property->hasDefaultValue)
    <i {{ $attributes->except('id') }}>{{ __('model-editor::form.na') }}</i>
@elseif (! $object && $property->defaultValue === null)
    <i {{ $attributes->except('id') }}>{{ __('model-editor::form.null') }}</i>
@elseif ($object && ! $editable && $object->{$property->variableName} === null)
    <i {{ $attributes->except('id') }}>{{ __('model-editor::form.null') }}</i>
@elseif ($object && $editable)
    <x-dynamic-component {{ $attributes }} :$component :$property />
@else
    <x-dynamic-component {{ $attributes->except('id') }} :$component :$property />
@endif
