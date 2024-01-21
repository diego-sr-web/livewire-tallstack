<?php

namespace App\Models\Machines;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StepSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'condition',
        'created_at',
        'updated_at',
    ];

    public function step(): BelongsTo
    {
        return $this->belongsTo(Step::class);
    }
}
