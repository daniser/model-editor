<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Handlers;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use TTBooking\ModelEditor\Contracts\TypeHandler;
use TTBooking\ModelEditor\Entities\AuraProperty;
use TTBooking\ModelEditor\Types\File;

class FileHandler implements TypeHandler
{
    public function __construct(protected Translator $translator) {}

    public function satisfies(AuraProperty $property): bool
    {
        return is_a($property->type->name, File::class, true)
            || $property->type->name === 'list' && is_a($property->type->parameters[0]->name, File::class, true);
    }

    public function description(AuraProperty $property): string
    {
        return $property->description;

        // $description = $this->translator->get($transKey);

        // return $description !== $transKey ? $description : $property->description;
    }

    public function component(): string
    {
        return 'model-editor::file';
    }

    public function handle(Request $request, Model $model, AuraProperty $property): void
    {
        $model->{$property->variableName} = $request->file($property->variableName)
            ->store($model->getKey().'/'.$property->variableName);
    }

    public function validate(Request $request, AuraProperty $property): bool
    {
        return true;
    }
}
