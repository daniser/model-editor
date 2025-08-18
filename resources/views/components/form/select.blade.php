@use(function Illuminate\Support\enum_value)
@use(function TTBooking\ModelEditor\Support\enum_desc)

@aware(['object'])
@props(['property', 'default' => false])

@if ($default)
    <span {{ $attributes }}>{{ enum_desc($property->defaultValue) }}</span>
@else
    <select {{ $attributes }} name="{{ $property->variableName }}" @disabled(! $property->writable)>
        @foreach ($property->type->name::cases() as $case)
            <option value="{{ enum_value($case) }}" @selected(enum_value($case) === enum_value($object->{$property->variableName}))>
                {{ enum_desc($case) }}
            </option>
        @endforeach
    </select>
@endif
