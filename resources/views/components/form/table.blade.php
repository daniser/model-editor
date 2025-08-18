<table {{ $attributes }}>
    <caption>
        @if (! isset($title) || $title->isEmpty())
            <h4>{!! Str::inlineMarkdown($summary) !!}</h4>
            <h5>{!! Str::markdown($description) !!}</h5>
        @else
            {{ $title }}
        @endif
    </caption>
    <tbody>
        @foreach ($aura->properties as $property)
            <x-model-editor::form.row :$property />
        @endforeach
    </tbody>
</table>
