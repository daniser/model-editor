<div>
    <h4>{{ $aura->summary }}</h4>
    <h5>{{ $aura->description }}</h5>
    <table>
        @foreach ($aura->properties as $property)
        <tr>
            <th>{{ $property->description }}</th>
            <td><x-model-editor::form.input :$property /></td>
        </tr>
        @endforeach
    </table>
</div>
