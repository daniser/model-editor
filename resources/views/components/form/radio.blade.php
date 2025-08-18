@use(function Illuminate\Support\enum_value)
@use(function TTBooking\ModelEditor\Support\enum_desc)

@aware(['object'])
@props(['property', 'default' => false])

@if ($default)
    <span {{ $attributes }}>{{ enum_desc($property->defaultValue) }}</span>
@else
    <fieldset {{ $attributes }} @disabled(! $property->writable)>
        @foreach ($property->type->name::cases() as $case)
            <label>
                <input type="radio" name="{{ $property->variableName }}" value="{{ enum_value($case) }}" @checked(enum_value($case) === enum_value($object->{$property->variableName})) />
                {{ enum_desc($case) }}
            </label>
        @endforeach
    </fieldset>
@endif
