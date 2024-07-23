<?php

namespace App\Http\Controllers;

use App\Models\Detalle_compras_tempral;
use App\Models\Productos;
use App\Models\Proveedores;
use Illuminate\Http\Request;

class DetalleComprasTemporalController extends Controller
{
    public function inicio(){
        $productos = Productos::where('estado', true)->paginate(5);
        $proveedores = Proveedores::where('estado', true)->get();
        $carrito = Detalle_compras_tempral::where('usuario_id', auth()->user()->id)->get();
        return view('compras.store', compact('productos', 'proveedores', 'carrito'));
    }
    public function agregarCarrito(string $id){
        $producto = Productos::find($id);
        if ($producto != null) {
            //pregunta si el producto se encuentra registrado en el carrito
            $existe = Detalle_compras_tempral::where('usuario_id', auth()->user()->id)->where('producto_id', $id)->first();
            if ($existe == null) {
                //añadir al carrito
                $item = new Detalle_compras_tempral();
                $item->producto_id = $id;
                $item->usuario_id = auth()->user()->id;
                $item->cantidad = 1;
                $item->precio_unitario = $producto->precio_compra;
                $item->total = $producto->precio_compra;
                $item->save();
                return back()->with('success', 'Producto añadido al carrito');
            } else {
                //solamente muestra un mensaje
                return back()->with('warning', 'El producto ya se encuentra registrado');
            }
        } else {
            //no existe el producto
            return back()->with('error', 'El producto no se encuentra registrado.');
        }
    }
    public function eliminarCarrito(string $id){
        $item = Detalle_compras_tempral::find($id);
        if ($item != null) {
            //elimina registro
            $item->delete();
            return back()->with('success', 'El producto fue eliminado del carrito.');
        } else {
            return back()->with('error', 'El producto no existe en el carrito.');
        }
    }
    public function incrementarCarrito(string $id){        
        $item = Detalle_compras_tempral::find($id);
        if ($item != null) {
            //incrementar cantidades
            $item->cantidad += 1;
            $item->total += $item->precio_unitario;
            $item->save();
            return back();
        } else {
            return back()->with('error', 'El producto no existe en el carrito.');
        } 
    }
    public function decrementarCarrito(string $id){
        $item = Detalle_compras_tempral::find($id);
        if ($item != null) {
            if($item->cantidad > 1){
                //decrementar cantidades
                $item->cantidad = $item->cantidad - 1;
                $item->total -= $item->precio_unitario;
                $item->save();
                return back();
            }else{
                //return redirect()->route('compras.eliminar-carrito', $id);
                return back()->with('warning', 'La cantidad no puede disminuir de 1.');
            }
        } else {
            return back()->with('error', 'El producto no existe en el carrito.');
        }
    }
}
