@use(function TTBooking\ModelEditor\Support\prop_val)
@use(function TTBooking\ModelEditor\Support\unquote)

@aware(['object', 'action', 'editable'])
@props(['property'])

@if ($action)
    <a {{ $attributes }} href="{{ $action.'/'.$property->variableName }}">
        @if (config('model-editor.show_uploaded_file_name'))
            {{ basename(prop_val($property, $object)) }}
        @else
            {{ __('model-editor::form.download') }}
        @endif
    </a>
@else
    <span {{ $attributes }}>
        @if (config('model-editor.show_uploaded_file_name'))
            {{ basename(prop_val($property, $object)) }}
        @else
            {{ __('model-editor::form.uploaded') }}
        @endif
    </span>
@endif

@if ($object && $editable)
    <input {{ $attributes }}
        type="file"
        name="{{ $property->variableName }}"
        @isset($property->type->parameters[1])
        accept="{{ unquote($property->type->parameters[1]) }}"
        @endisset
        {!! $property->type->name === 'list' ? 'multiple' : '' !!}
        @readonly(! $property->writable)
    />
@endif
