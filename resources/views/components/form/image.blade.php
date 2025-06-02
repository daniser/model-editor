<img src="{{ $preview }}" alt="" />
<input {{ $attributes }} type="file" name="{{ $property->variableName }}" value="{{ $model->{$property->variableName} }}" {!! $property->type->name === 'list' ? 'multiple' : '' !!} @readonly(! $property->writable) />
