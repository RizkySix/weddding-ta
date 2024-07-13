<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rating extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function package() : BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function ratingParticipants() : HasMany
    {
        return $this->hasMany(RatingParticipant::class);
    }
}
