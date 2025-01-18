<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Brindes extends Model
{
    use HasFactory;

    protected $table = 'brindes';

    protected $fillable = ['brinde', 'valor'];

    public $timestamps = true;
}
