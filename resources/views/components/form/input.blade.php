@aware(['alias'])
@props(['default' => false])

@if ($default && ! $property->hasDefaultValue)
    <i>{{ __('model-editor::form.na') }}</i>
@elseif ($default && $property->defaultValue === null)
    <i>{{ __('model-editor::form.null') }}</i>
@else
    <x-dynamic-component {{ $attributes }} :$component :$property :$default />
@endif
