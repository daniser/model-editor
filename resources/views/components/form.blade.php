<div>
    <h1>{{ $aura->summary }}</h1>
    <h2>{{ $aura->description }}</h2>
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
