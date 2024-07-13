<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Package extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function price() : HasOne
    {
        return $this->hasOne(Price::class);
    }

    public function catalog() : HasMany
    {
        return $this->hasMany(Catalog::class);
    }

    public function booking() : HasMany
    {
        return $this->hasMany(PackageBooking::class);
    }

    public function decoration(): BelongsToMany
    {
        return $this->belongsToMany(Decoration::class, 'package_decoration' , 'package_id' , 'decoration_id')
                    ->withPivot('added_at');
    }

    public function rating() : HasOne
    {
        return $this->hasOne(Rating::class);
    }
    
}
