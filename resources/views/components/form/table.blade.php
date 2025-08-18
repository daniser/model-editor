<table {{ $attributes }}>
    <caption>
        @if (! isset($title) || $title->isEmpty())
            <h4>{!! Str::inlineMarkdown($summary) !!}</h4>
            <h5>{!! Str::markdown($description) !!}</h5>
        @else
            {{ $title }}
        @endif
    </caption>
    <thead>
        <th>{{ __('model-editor::form.description') }}</th>
        <th>{{ __('model-editor::form.value') }}</th>
        <th>{{ __('model-editor::form.default') }}</th>
    </thead>
    <tbody>
        @foreach ($aura->properties as $property)
            <x-model-editor::form.row :$property />
        @endforeach
    </tbody>
</table>
