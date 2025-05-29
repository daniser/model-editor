@aware(['model'])
@props(['property'])

<select {{ $attributes }} name="{{ $property->variableName }}" @disabled(! $property->writable)>
    @foreach ($property->type->name::cases() as $case)
        <option value="{{ $case->value }}" @selected($case->value === $model->{$property->variableName}->value)>{{ $case->value }}</option>
    @endforeach
</select>
