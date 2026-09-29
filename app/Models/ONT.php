<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ont extends Model
{
    use HasFactory;

    protected $table = 'w_ont'; // Cambia por el nombre real de tu tabla si es distinto
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'marca',
        'modelo',
    ];

    // Relación de 1 a N con Reserva
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'idOnt');
    }
}