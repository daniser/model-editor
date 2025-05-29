@aware(['model'])
@props(['property'])

<select {{ $attributes }} name="{{ $property->variableName }}" @disabled(! $property->writable)>
    @foreach ($property->type->cases as $case)
        <option value="{{ $case }}" @selected($case === $model->{$property->variableName}->value)>{{ $case }}</option>
    @endforeach
</select>
