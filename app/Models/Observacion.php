<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    use HasFactory;

    protected $table = 'w_observacion'; // Ajusta el nombre de la tabla si es necesario
    public $timestamps = false;

    protected $fillable = [
        'idReserva',
        'texto',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    // Relación pertenencia a Reserva
    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'idReserva');
    }
}