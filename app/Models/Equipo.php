<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'w_equipo';
    public $timestamps = false; // Desactivar si la tabla no usa created_at/updated_at

    protected $fillable = [
        'idUra',
        'idServicio',
        'ip',
        'nombre',
        'latitud',
        'longitud',
        'user',
        'passw',
    ];

    public function ura()
    {
        return $this->belongsTo(Ura::class, 'idUra');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'idServicio');
    }
}