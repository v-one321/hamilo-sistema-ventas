<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;
    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }
    public function proveedores(){
        return $this->belongsTo(Proveedores::class, 'proveedor_id');
    }
    public function detalle_compra(){
        return $this->hasMany(Detalle_compras::class, 'compra_id');
    }
}
