<?php

namespace App\Models\Companies;

use App\Models\Addresses\Address;
use App\Models\Contacts\Contact;
use App\Models\Documents\Document;
use App\Models\Users\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fantasy_name',
        'site',
        'status',
    ];

    public function profile(): MorphOne
    {
        return $this->morphOne(Profile::class, 'rel');
    }

    public function contacts(): MorphMany
    {
        return $this->morphMany(Contact::class, 'rel', 'rel_type', 'rel_id');
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'rel', 'rel_type', 'rel_id');
    }

    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'rel', 'rel_type', 'rel_id');
    }
}
