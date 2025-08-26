@use(function TTBooking\ModelEditor\Support\prop_val)

@aware(['object', 'action', 'editable'])
@props(['property'])

@php($file = prop_val($property, $object))

@if ($file)
    @if ($action)
        <a {{ $attributes }}
           href="{{ $action.'/'.$property->variableName }}"
           @if ($file->contentDisposition === 'inline')
           target="_blank"
           @endif
        >
            @if (config('model-editor.show_uploaded_file_name'))
                {{ basename($file) }}
            @elseif ($file->contentDisposition === 'inline')
                {{ __('model-editor::form.open') }}
            @else
                {{ __('model-editor::form.download') }}
            @endif
        </a>
    @else
        <span {{ $attributes }}>
            @if (config('model-editor.show_uploaded_file_name'))
                {{ basename($file) }}
            @else
                {{ __('model-editor::form.uploaded') }}
            @endif
        </span>
    @endif
@endif

@if ($object && $editable)
    <input {{ $attributes }}
        type="file"
        name="{{ $property->variableName }}"
        @isset($property->type->parameters[1])
        accept="{{ $property->type->parameters[1]->asConstExpr() }}"
        @endisset
        {!! $property->type->name === 'list' ? 'multiple' : '' !!}
        @readonly(! $property->writable)
    />
@endif
