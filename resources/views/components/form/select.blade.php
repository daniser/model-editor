@use(function Illuminate\Support\enum_value)

@aware(['model'])
@props(['property'])

<select {{ $attributes }} name="{{ $property->variableName }}" @disabled(! $property->writable)>
    @foreach ($property->type->name::cases() as $case)
        <option value="{{ enum_value($case) }}" @selected(enum_value($case) === enum_value($model->{$property->variableName}))>{{ enum_value($case) }}</option>
    @endforeach
</select>
