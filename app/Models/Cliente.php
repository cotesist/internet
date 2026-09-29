<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Cliente extends Model
{
    protected $table = 'w_cliente';
    
    const CREATED_AT = 'fecha_registro';
    const UPDATED_AT = 'fecha_update';

    protected $fillable = [
        'nombre',
        'telefono',
        'celular',
        'idUser'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'idCliente');
    }

}