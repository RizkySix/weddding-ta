<?php

namespace App\Observers;

use App\Models\Package;
use App\Trait\HelperTrait;

class CreateRatingPackage
{
    use HelperTrait;
    /**
     * Handle the Package "created" event.
     */
    public function created(Package $package): void
    {
        $package->rating()->create([
            'uuid' => $this->setUuid(),
        ]);
    }

    /**
     * Handle the Package "updated" event.
     */
    public function updated(Package $package): void
    {
        //
    }

    /**
     * Handle the Package "deleted" event.
     */
    public function deleted(Package $package): void
    {
        //
    }

    /**
     * Handle the Package "restored" event.
     */
    public function restored(Package $package): void
    {
        //
    }

    /**
     * Handle the Package "force deleted" event.
     */
    public function forceDeleted(Package $package): void
    {
        //
    }
}
