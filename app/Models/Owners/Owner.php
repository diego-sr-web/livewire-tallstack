<?php

namespace App\Models\Owners;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fantasy_name',
        'cnpj',
    ];
}
