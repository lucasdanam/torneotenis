<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class JugadorMasculino extends Model
{
    use HasFactory;
    protected $table = 'jugadoresmasculinos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'dni',
        'habilidad',
        'fuerza',
        'velocidad'
    ];
}