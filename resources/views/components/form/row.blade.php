@aware(['object', 'editable'])

<tr>
    <th>
        @if ($editable)
            <label for="{{ $id }}" title="{{ $property->variableName }}">{!! Str::inlineMarkdown($description) ?: $property->variableName !!}</label>
        @else
            <span title="{{ $property->variableName }}">{!! Str::inlineMarkdown($description) ?: $property->variableName !!}</span>
        @endif
    </th>
    <td><x-model-editor::form.input :$id :$property :$object /></td>
    <td><x-model-editor::form.input :$id :$property /></td>
</tr>
