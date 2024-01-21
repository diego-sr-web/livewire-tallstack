<?php

namespace App\Models\Machines;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineQueue extends Model
{
    use HasFactory;

    protected $fillable = [
        'step_id',
        'name',
        'slug',
    ];
}
