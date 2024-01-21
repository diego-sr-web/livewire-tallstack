<?php

namespace App\Models\MailMarketingTemplates;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailMarketingTemplate extends Model
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
