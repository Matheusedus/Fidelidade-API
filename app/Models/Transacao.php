<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Transacao extends Model
{
    protected $table = 'transacoes';

    protected $fillable = ['cliente_id', 'valor_gasto', 'pontos_ganhos'];

    public $timestamps = true;

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }   
}
