<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JugadorFemenino extends Model
{
    use HasFactory;
    protected $table = 'jugadoresfemeninos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nombre',
        'dni',
        'habilidad',
        'reaccion'
    ];

    public function torneos(){
        return $this->belongsToMany(Torneo::class,'torneo_jugadora','torneo_id','jugador_id')
            ->withPivot('torneo_id');
    }
}