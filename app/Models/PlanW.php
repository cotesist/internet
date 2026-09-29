<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanW extends Model
{
    use HasFactory;

    protected $table = 'w_plan_w';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'profile',
        'velocidad_up',
        'velocidad_down',
    ];

    // Un Plan W puede estar en muchas Reservas
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'idPlanw');
    }
}