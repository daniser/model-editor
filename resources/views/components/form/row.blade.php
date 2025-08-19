@aware(['object'])

<tr>
    <th><label for="{{ $id }}" title="{{ $property->variableName }}">{!! Str::inlineMarkdown($description) ?: $property->variableName !!}</label></th>
    <td><x-model-editor::form.input :$id :$property :$object /></td>
    <td><x-model-editor::form.input :$id :$property /></td>
</tr>
