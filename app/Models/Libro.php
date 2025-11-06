<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'autor', 'anio_publicacion', 'isbn', 'genero_id'];

    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }

    protected function prestado(): Attribute
    {
        return Attribute::get(fn () => $this->prestamos()->whereNull('fecha_devolucion_real')->exists());
    }
}
