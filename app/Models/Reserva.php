<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Reserva extends Model
{
    protected $table = 'w_reserva';

    const CREATED_AT = 'fecha_registro';
    const UPDATED_AT = 'fecha_update';

    protected $fillable = [
        'idCliente',
        'idServicio',
        'idEquipo',
        'idPlanr',
        'idPlanw',
        'estado',
        'serie',
        'fibra',
        'tv',
        'linea',
        'fecha_anulacion',
        'idUser'
    ];

    // --- RELACIONES ---

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'idServicio');
    }

    public function ont()
    {
        return $this->belongsTo(Ont::class, 'idEquipo');
    }

    public function planR()
    {
        return $this->belongsTo(PlanR::class, 'idPlanr');
    }

    public function planW()
    {
        return $this->belongsTo(PlanW::class, 'idPlanw');
    }

    public function observaciones()
    {
        return $this->hasMany(Observacion::class, 'idReserva');
    }

    public function lineas()
    {
        return $this->hasMany(Linea::class, 'idReserva');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
    public function puertos()
    {
        return $this->hasMany(Puerto::class, 'idReserva');
    }

    // --- SCOPE DE BÚSQUEDA ---

    /**
     * Busca únicamente por las relaciones (Cliente, Servicio, ONT/Equipo, PlanR, PlanW) 
     * e IDs de forma case-insensitive.
     */
    public function scopeBuscar(Builder $query, ?string $search): Builder
    {
        if (empty(trim($search))) {
            return $query;
        }

        $term = '%' . mb_strtolower(trim($search), 'UTF-8') . '%';

        return $query->where(function ($q) use ($term) {
            // Coincidencias por IDs directos de la clave foránea
            $q->whereRaw('CAST(idCliente AS CHAR) LIKE ?', [$term])
              ->orWhereRaw('CAST(idServicio AS CHAR) LIKE ?', [$term])
              ->orWhereRaw('CAST(idEquipo AS CHAR) LIKE ?', [$term])
              ->orWhereRaw('CAST(idPlanr AS CHAR) LIKE ?', [$term])
              ->orWhereRaw('CAST(idPlanw AS CHAR) LIKE ?', [$term])

              // Búsqueda en los nombres de las tablas relacionadas
              ->orWhereHas('cliente', function ($qC) use ($term) {
                  $qC->whereRaw('LOWER(nombre) LIKE ?', [$term]);
              })
              ->orWhereHas('servicio', function ($qS) use ($term) {
                  $qS->whereRaw('LOWER(nombre) LIKE ?', [$term]);
              })
              ->orWhereHas('ont', function ($qE) use ($term) {
                  $qE->whereRaw('LOWER(nombre) LIKE ?', [$term]);
              })
              ->orWhereHas('planR', function ($qPr) use ($term) {
                  $qPr->whereRaw('LOWER(nombre) LIKE ?', [$term]);
              })
              ->orWhereHas('planW', function ($qPw) use ($term) {
                  $qPw->whereRaw('LOWER(nombre) LIKE ?', [$term]);
              });
        });
    }
}