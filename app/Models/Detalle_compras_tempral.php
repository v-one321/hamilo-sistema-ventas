<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_compras_tempral extends Model
{
    use HasFactory;
    public function producto(){
        return $this->belongsTo(Productos::class, 'producto_id');
    }
}
