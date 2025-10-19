<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $fillable = ['nombre', 'descripcion'];

    public function libros()
    {
        return $this->hasMany(Libro::class);
    }
}
