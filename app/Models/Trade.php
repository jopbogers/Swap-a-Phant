<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trade extends Model
{
    protected $fillable = ['initiator_id', 'target_id', 'offer_elephant_id', 'request_elephant_id', 'status'];

    // Relationships
    public function initiator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'initiator_id');
    }

    public function target(): BelongsTo
    {
        return $this->belongsTo(User::class, 'target_id');
    }

    public function offerElephant(): BelongsTo
    {
        return $this->belongsTo(Elephant::class, 'offer_elephant_id');
    }

    public function requestElephant(): BelongsTo
    {
        return $this->belongsTo(Elephant::class, 'request_elephant_id');
    }
}
