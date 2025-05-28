<form {{ $attributes->only(['id', 'action']) }} method="POST">
    @method('PUT')
    @if (! isset($title) || $title->isEmpty())
        <h4>{{ $aura->summary }}</h4>
        <h5>{{ $aura->description }}</h5>
    @else
        {{ $title }}
    @endif
    <table {{ $attributes->except(['id', 'action']) }}>
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
