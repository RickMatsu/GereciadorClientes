<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operadora extends Model
{
    public function clientes()
    {
        return $this->hasMany(Cliente::class); // A operadora tem muitos clientes
    }
}
