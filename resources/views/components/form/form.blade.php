<form {{ $attributes->only(['id', 'action', 'enctype']) }} method="POST">
    @method('PUT')
    @if (! isset($title) || $title->isEmpty())
        <h4>{!! Str::inlineMarkdown($summary) !!}</h4>
        <h5>{!! Str::markdown($description) !!}</h5>
    @else
        {{ $title }}
    @endif
    <table {{ $attributes->except(['id', 'action', 'enctype']) }}>
        @foreach ($aura->properties as $property)
            <x-model-editor::form.row :$property />
        @endforeach
    </table>
    @if (! isset($buttons) || $buttons->isEmpty())
        <button type="submit">Save</button>
    @else
        {{ $buttons }}
    @endif
</form>
