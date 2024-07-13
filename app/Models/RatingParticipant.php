<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RatingParticipant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function rating() : BelongsTo
    {
        return $this->belongsTo(Rating::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
