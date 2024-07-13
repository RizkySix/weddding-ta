<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
class Decoration extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function setCreatedByAttribute($value = null)
    {
        $this->attributes['created_by'] = auth()->user()?->name ?? 'Admin';
    }

    public function setUuidAttribute($value = null)
    {
        $this->attributes['uuid'] = Str::uuid();
    }

    public function package(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'package_decoration' , 'decoration_id' , 'package_id')
                    ->withPivot('added_at');
    }
}
