<?php

namespace App\Models\Meis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mei extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'mei_cnpj',
        'mei_nome',
        'mei_email',
        'mei_telefone',
        'mei_entregue',
        'mei_cep',
        'mei_lastupdate',
        'mei_situacao',
        'mei_status',
        'mei_ano',
        'mei_endereco',
        'mei_numero',
        'mei_complemento',
        'mei_bairro',
        'mei_cidade',
        'mei_uf',
        'mei_cnae',
        'mei_cnae_desc'
    ];

}