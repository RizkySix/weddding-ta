<?php

namespace App\Models;

use App\Trait\HelperTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    use HasFactory, HelperTrait;

    protected $guarded = ['id'];

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $this->setCleanPrice($value);
    }

    public function package() : BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
