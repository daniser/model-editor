<tr>
    <th><label for="{{ $id }}" title="{{ $property->variableName }}">{{ $description ?: $property->variableName }}</label></th>
    <td><x-model-editor::form.input :$property :$id /></td>
</tr>
