<?php

namespace App\Models\Machines;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Step extends Model
{
    use HasFactory;

    protected $fillable = [
        'step_settings_id',
        'sequence_id',
        'mail_template_id',
        'name',
        'description',
        'active',
        'status',
        'leads_reached',
        'sent',
        'open',
        'clicks',
    ];

    public function sequence(): BelongsTo
    {
        return $this->belongsTo(Sequence::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(StepLog::class)->orderBy('id', 'DESC');
    }

    public function settings(): BelongsTo
    {
        return $this->belongsTo(StepSettings::class, 'step_settings_id', 'id');
    }
}
