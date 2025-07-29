@use(function Illuminate\Support\enum_value)
@use(function TTBooking\ModelEditor\Support\enum_desc)

@aware(['object'])
@props(['property'])

<select {{ $attributes }} name="{{ $property->variableName }}" @disabled(! $property->writable)>
    @foreach ($property->type->name::cases() as $case)
        <option value="{{ enum_value($case) }}" @selected(enum_value($case) === enum_value($object->{$property->variableName}))>
            {{ enum_desc($case) }}
        </option>
    @endforeach
</select>
