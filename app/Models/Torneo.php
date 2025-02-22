<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Torneo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
    ];

    public function jugadoresmasculinos(): BelongsToMany
    {
        return $this->belongsToMany(
            JugadorMasculino::class,
            'torneo_jugador',
            'torneo_id',
            'jugador_id'
        )->withPivot('jugador_id', 'torneo_id');
    }

    public function jugadoresfemeninos(): BelongsToMany
    {
        return $this->belongsToMany(
            JugadorFemenino::class,
            'torneo_jugadora',
            'torneo_id',
            'jugador_id',
        )->withPivot('jugador_id', 'torneo_id');
    }
}