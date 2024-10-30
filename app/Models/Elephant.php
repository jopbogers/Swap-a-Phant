<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Elephant extends Model
{
    protected $fillable = ['name', 'description', 'image_path'];

    public function collections(): HasMany
    {
        return $this->hasMany(Collection::class);
    }

    public function tradesAsOffer(): HasMany
    {
        return $this->hasMany(Trade::class, 'offer_elephant_id');
    }

    public function tradesAsRequest(): HasMany
    {
        return $this->hasMany(Trade::class, 'request_elephant_id');
    }
}
