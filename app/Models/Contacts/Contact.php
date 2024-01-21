<?php

namespace App\Models\Contacts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'rel_id',
        'rel_type',
        'contact_type_id',
        'contact',
        'active',
    ];

    public function contactType(): BelongsTo
    {
        return $this->belongsTo(ContactType::class);
    }
}
