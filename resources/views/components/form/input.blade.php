@aware(['alias', 'editable'])

@if (! $object && ! $property->hasDefaultValue)
    <i {{ $attributes }}>{{ __('model-editor::form.na') }}</i>
@elseif (! $object && $property->defaultValue === null)
    <i {{ $attributes }}>{{ __('model-editor::form.null') }}</i>
@elseif ($object && ! $editable && $object->{$property->variableName} === null)
    <i {{ $attributes }}>{{ __('model-editor::form.null') }}</i>
@else
    <x-dynamic-component {{ $attributes }} :$component :$property />
@endif
