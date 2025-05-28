@aware(['alias'])

<x-dynamic-component :$component :$property :id="$alias.'_'.Str::snake($property->variableName)" />
