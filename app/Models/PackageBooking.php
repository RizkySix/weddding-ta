<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PackageBooking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function setStartDate($value)
    {
        $this->attributes['start_date'] = Carbon::parse($value)->setHour(0)->setMinute(0)->setSecond(0);
    }

    public function setEndDate($value)
    {
        $this->attributes['end_date'] = Carbon::parse($value)->setHour(0)->setMinute(0)->setSecond(0);
    }


    public function getStartDateAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y');
    }

    public function getEndDateAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y');
    }

    public function package() : BelongsTo
    {
        return $this->belongsTo(Package::class , 'package_id');
    }

    public function order() : HasOne
    {
        return $this->hasOne(Order::class);
    }
}
