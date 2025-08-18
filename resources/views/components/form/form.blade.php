@props(['object'])

<form {{ $attributes->only(['id', 'action', 'enctype']) }} method="POST">
    @method('PUT')
    <x-model-editor::form.table {{ $attributes->except(['id', 'action', 'enctype']) }} :$object />
    @if (! isset($buttons) || $buttons->isEmpty())
        <button type="submit">Save</button>
    @else
        {{ $buttons }}
    @endif
</form>
