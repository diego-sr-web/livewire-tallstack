<?php

namespace App\Models\Machines;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sequence extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine_id',
        'name',
        'description',
        'active',
        'status',
        'order',
    ];

    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }
    
    public function logs(): HasMany
    {
        return $this->hasMany(SequenceLog::class)->orderBy('id', 'DESC');
    }
}