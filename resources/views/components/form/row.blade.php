<tr>
    <th><label for="{{ $id }}" title="{{ $property->variableName }}">{!! Str::inlineMarkdown($description) ?: $property->variableName !!}</label></th>
    <td><x-model-editor::form.input :$property :$id /></td>
    <td><x-model-editor::form.input :$property :$id :default="true" /></td>
</tr>
