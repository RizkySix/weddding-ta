<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getExpiredAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y H:i');
    }

    public function booking() : BelongsTo
    {
        return $this->belongsTo(PackageBooking::class, 'package_booking_id');
    }

    public function reference() : HasOne
    {
        return $this->hasOne(OrderReference::class , 'order_id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
