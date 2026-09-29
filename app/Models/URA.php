<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ura extends Model
{
    use HasFactory;

    protected $table = 'w_ura'; // Cambia según el nombre exacto de tu tabla
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'ubicacion',
        'fecha_reg',
        'fecha_up',
        'id_user',
    ];

    protected $casts = [
        'fecha_reg' => 'datetime',
        'fecha_up'  => 'datetime',
    ];

    // Relación con el usuario creador/modificador
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}