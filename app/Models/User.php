<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';

    // Se mapea la columna de borrado suave al campo personalizado de la BD
    const DELETED_AT = 'deletedAt';

    protected $fillable = [
        'nombre',
        'usuario',
        'email',
        'password_hash',
        'tipo_usuario',
        'isActive',
        'userDeleted',
    ];

    protected $hidden = [
        'password_hash',
    ];

    // Indica a Laravel que use password_hash para la autenticación
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    // Mutador para encriptar la contraseña automáticamente al asignar
    public function setPasswordHashAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password_hash'] = Hash::make($value);
        }
    }
}