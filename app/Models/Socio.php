<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'email', 'telefono', 'activo'];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }

    public function permitido()
    {
        return $this->prestamos()
            ->where('fecha_devolucion_real', null)
            ->where('activo', true);
    }
}
