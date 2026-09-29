<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanR extends Model
{
    use HasFactory;

    protected $table = 'w_plan_r';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'profile',
    ];

    // Un Plan R tiene muchas Reservas
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'idPlanr');
    }
}