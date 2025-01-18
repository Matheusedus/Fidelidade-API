<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recompensa extends Model
{
    protected $fillable = ['cliente_id', 'fk_brinde', 'pontos_usados'];

    public $timestamps = true;

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }
}
