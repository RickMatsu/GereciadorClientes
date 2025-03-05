<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Especificando quais campos podem ser preenchidos diretamente no banco
    protected $fillable = [
        'nome', 
        'email', 
        'cpf', 
        'cnpj', 
        'operadora_id', 
        'status_id', 
        'data_nascimento', 
        'data_recebimento', 
        'nome_empresa', 
        'valor', 
        'numero_proposta', 
        'observacao'
    ];

    public function operadora()
    {
        return $this->belongsTo(Operadora::class, 'operadora_id', 'id');
    }

    public function statusCliente()
    {
        return $this->belongsTo(StatusCliente::class, 'status_id', 'id');
    }
}

