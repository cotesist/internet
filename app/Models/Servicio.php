<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    // Si tu tabla en BD se llama 'w_servicio', cámbialo aquí. Si se llama 'servicios', puedes omitir esta línea.
    protected $table = 'w_servicio';
    public $timestamps = false; // Desactivar si la tabla no usa created_at/updated_at

    protected $fillable = [
        'nombre',
    ];

    // Relación opcional hacia Equipos
    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'idServicio');
    }
}