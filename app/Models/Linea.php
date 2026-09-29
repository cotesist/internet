<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    use HasFactory;

    protected $table = 'w_linea';
    public $timestamps = false;

    protected $fillable = [
        'idReserva',
        'telefono',
        'clave'
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'idReserva');
    }
}