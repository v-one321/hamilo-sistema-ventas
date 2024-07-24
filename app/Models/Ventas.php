<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }
    public function clientes(){
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }
    public function detalle_venta(){
        return $this->hasMany(Detalle_ventas::class, 'venta_id');
    }
}
