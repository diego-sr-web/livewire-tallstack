<?php

namespace App\Models\Leads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Lead extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'step_id',
        'name',
        'email',
        'internacionalization',
        'active',
        'status',
        'annual_declaration',
        'option',
        'exclusive',
    ];
}