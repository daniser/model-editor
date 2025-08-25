<form {{ $attributes->only(['id', 'action', 'enctype'])->merge($mergeAttrs) }} method="POST">
    @method('PUT')
    <x-model-editor::form.table {{ $attributes->except(['id', 'enctype']) }} :$object :$showDefaults :editable="true" />
    @if (! isset($buttons) || $buttons->isEmpty())
        <button type="submit">{{ __('model-editor::form.save') }}</button>
    @else
        {{ $buttons }}
    @endif
</form>
