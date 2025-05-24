<div>
    <h4>{{ $aura->summary }}</h4>
    <h5>{{ $aura->description }}</h5>
    <table>
        @foreach ($aura->properties as $property)
        <tr>
            <th>{{ $property->description }}</th>
            @php($component = TypeHandler::for($property)->component())
            <td><x-dynamic-component :$component :$model :$property /></td>
        </tr>
        @endforeach
    </table>
</div>
