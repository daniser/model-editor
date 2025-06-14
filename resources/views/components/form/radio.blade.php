@use(function Illuminate\Support\enum_value)
@use(function TTBooking\ModelEditor\Support\enum_desc)

@aware(['model'])
@props(['property'])

<fieldset {{ $attributes }} @disabled(! $property->writable)>
    @foreach ($property->type->name::cases() as $case)
        <label>
            <input type="radio" name="{{ $property->variableName }}" value="{{ enum_value($case) }}" @checked(enum_value($case) === enum_value($model->{$property->variableName})) />
            {{ enum_desc($case) }}
        </label>
    @endforeach
</fieldset>
