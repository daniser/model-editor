@use(function TTBooking\ModelEditor\Support\prop_val)

@aware(['action', 'editable'])

@php($file = prop_val($property, $object))

@if ($file)
    @if ($action)
        <a {{ $attributes }}
           href="{{ $action.'/'.$property->variableName }}"
           @if ($file->contentDisposition === 'inline')
           target="_blank"
           @endif
           title="{{ basename($file) }}"
        >
            <img src="{{ $preview }}" alt="{{ basename($file) }}" />
        </a>
    @else
        <span {{ $attributes }} title="{{ basename($file) }}">
            <img src="{{ $preview }}" alt="{{ basename($file) }}" />
        </span>
    @endif
@endif

@if ($object && $editable)
    <input {{ $attributes }}
        type="file"
        name="{{ $property->variableName }}"
        @isset($property->type->parameters[1])
        accept="{{ $property->type->parameters[1]->asConstExpr() }}"
        @else
        accept="image/*"
        @endisset
        {!! $property->type->name === 'list' ? 'multiple' : '' !!}
        @readonly(! $property->writable)
    />
@endif
