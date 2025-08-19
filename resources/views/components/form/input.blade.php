@aware(['alias', 'editable'])

@if (! $object && ! $property->hasDefaultValue)
    <i {{ $attributes->except('id') }}>{{ __('model-editor::form.na') }}</i>
@elseif (! $object && $property->defaultValue === null)
    <i {{ $attributes->except('id') }}>{{ __('model-editor::form.null') }}</i>
@elseif ($object && ! $editable && $object->{$property->variableName} === null)
    <i {{ $attributes->except('id') }}>{{ __('model-editor::form.null') }}</i>
@else
    <x-dynamic-component {{ $object && $editable ? $attributes : $attributes->except('id') }} :$component :$property />
@endif
