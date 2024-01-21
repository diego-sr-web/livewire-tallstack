<?php

namespace App\Models\MailTransactionalTemplates;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailTransactionalTemplate extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id', 
        'company_id', 
        'title',
        'preheader',
        'subject', 
        'body', 
        'status',
        'page'
    ];
}
