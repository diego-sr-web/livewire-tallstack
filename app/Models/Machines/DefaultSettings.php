<?php

namespace App\Models\Machines;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultSettings extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'name',
        'condition',
        'active',
    ];
}
