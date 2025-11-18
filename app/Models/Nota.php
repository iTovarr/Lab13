<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nota extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'titulo', 'contenido'];
    protected $hidden = [

    ];

    public function getTituloFormateadoAttribute()
    {
        return $this->titulo . " (" . $this->id . ")";
    }

    public function recordatorio()
    {
        return $this->hasOne(Recordatorio::class);
    }

    public function actividades()
    {
        return $this->hasMany(Actividad::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (Nota $nota) {
            if ($nota->recordatorio) {
                $nota->recordatorio->delete();
            }
            $nota->actividades()->delete();
        });
    }
}