<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puerto extends Model
{
    use HasFactory;

    protected $table = 'w_puerto';
    public $timestamps = false; // Desactivar si la tabla no usa created_at/updated_at

    protected $fillable = [
        'idEquipo',
        'idReserva',
        'pon',
        'puerto',
        'estado',
    ];

    // Relación con Equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'idEquipo');
    }
    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'idReserva');
    }
}