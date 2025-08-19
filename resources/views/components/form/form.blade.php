@props(['object'])

<form {{ $attributes->only(['id', 'action', 'enctype']) }} method="POST">
    @method('PUT')
    <x-model-editor::form.table {{ $attributes->except(['id', 'action', 'enctype']) }} :$object :editable="true" />
    @if (! isset($buttons) || $buttons->isEmpty())
        <button type="submit">{{ __('model-editor::form.save') }}</button>
    @else
        {{ $buttons }}
    @endif
</form>
