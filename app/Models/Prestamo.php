<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Prestamo extends Model
{
    protected $fillable = ['libro_id', 'socio_id', 'user_id', 'fecha_prestamo', 'fecha_devolucion', 'fecha_devolucion_real', 'sancion', 'fecha_notificacion'];

    protected $casts = [
        'fecha_prestamo' => 'date',
        'fecha_devolucion' => 'date',
        'fecha_devolucion_real' => 'date',
        'fecha_notificacion' => 'date',
    ];

    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    protected function diasTranscurridos(): Attribute
    {
        return Attribute::get(function () {
            $inicio = Carbon::parse($this->fecha_prestamo);
            $fin = $this->fecha_devolucion_real
                ? Carbon::parse($this->fecha_devolucion_real)
                : Carbon::today();

            return $inicio->diffInDays($fin);
        });
    }

    protected function diasSancion(): Attribute
    {
        return Attribute::get(function () {
            $inicio = Carbon::parse($this->fecha_devolucion);
            $fin = $this->fecha_devolucion_real
                ? Carbon::parse($this->fecha_devolucion_real)
                : Carbon::parse($this->fecha_devolucion);

            return $dias = $inicio->diffInDays($fin) > 0 ? $inicio->diffInDays($fin) : 0;
        });
    }
}
