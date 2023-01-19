<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'devoluciones';

    protected $fillable = ['Fecha_devolucion','prestamos_id','libros_id','elementos_id','usuario_id','curso_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function curso()
    {
        return $this->hasOne('App\Models\Curso', 'id', 'curso_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function elemento()
    {
        return $this->hasOne('App\Models\Elemento', 'id', 'elementos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function libro()
    {
        return $this->hasOne('App\Models\Libro', 'id', 'libros_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function prestamo()
    {
        return $this->hasOne('App\Models\Prestamo', 'id', 'prestamos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }

}
