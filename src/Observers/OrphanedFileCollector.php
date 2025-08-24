<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor\Observers;

use Illuminate\Database\Eloquent\Model;
use TTBooking\ModelEditor\Types\File;

class OrphanedFileCollector
{
    /**
     * Cleanup orphaned uploaded files.
     */
    public function deleting(Model $model): void
    {
        if (method_exists($model, 'isForceDeleting') && ! $model->isForceDeleting()) {
            return;
        }

        foreach ($model->getAttributes() as $maybeFile) {
            $maybeFile instanceof File && $maybeFile->delete();
        }
    }
}
