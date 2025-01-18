<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Cliente extends Model
{
    protected $fillable = ['nome', 'email', 'saldo_pontos'];

    public function transacoes(): HasMany
    {
        return $this->hasMany(Transacao::class);
    }

    public function recompensas(): HasMany
    {
        return $this->hasMany(Recompensa::class);
    }
}
