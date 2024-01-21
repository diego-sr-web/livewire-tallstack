<?php

namespace App\Models\Machines;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MachineLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine_id',
        'rel_id',
        'rel_type',
        'action',
        'log',
    ];

    public function relation(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'rel_type', 'rel_id');
    }

    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }
}
