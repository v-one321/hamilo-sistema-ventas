<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Detalle_ventas;
use App\Models\Detalle_ventas_temporal;
use App\Models\Productos;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetalleVentasTemporalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function inicio(){
        $productos = Productos::where('estado', true)->where('cantidad', '>', 0)->paginate(5);
        $clientes = Clientes::where('estado', true)->get();
        $carrito = Detalle_ventas_temporal::where('usuario_id', auth()->user()->id)->get();
        $sumaTotal = Detalle_ventas_temporal::selectRaw('SUM(total) AS suma')->where('usuario_id', auth()->user()->id)->first();
        return view('ventas.store', compact('productos', 'clientes', 'carrito', 'sumaTotal'));
    }
    public function agregarCarrito(string $id){
        $producto = Productos::find($id);
        if ($producto != null) {
            $existe = Detalle_ventas_temporal::where('usuario_id', auth()->user()->id)->where('producto_id', $id)->first();
            if ($existe == null) {
                $item = new Detalle_ventas_temporal();
                $item->producto_id = $id;
                $item->usuario_id = auth()->user()->id;
                $item->cantidad = 1;
                $item->precio_unitario = $producto->precio_venta;
                $item->total = $producto->precio_venta;
                $item->save();
                return back()->with('success', 'Producto añadido al carrito');
            } else {
                return back()->with('warning', 'El producto ya se encuentra registrado');
            }
        } else {
            return back()->with('error', 'El producto no se encuentra registrado.');
        }
    }
    public function eliminarCarrito(string $id){
        $item = Detalle_ventas_temporal::find($id);
        if ($item != null) {
            $item->delete();
            return back()->with('success', 'El producto fue eliminado del carrito.');
        } else {
            return back()->with('error', 'El producto no existe en el carrito.');
        }
    }
    public function incrementarCarrito(string $id){        
        $item = Detalle_ventas_temporal::find($id);
        if ($item != null) {
            $producto = Productos::find($item->producto_id);
            if ($producto->cantidad > $item->cantidad) {
                $item->cantidad += 1;
                $item->total += $item->precio_unitario;
                $item->save();
                return back();
            } else {
                return back()->with('warning', 'La cantidad SOLICITADA no puede ser mayor al STOCK del producto.');
            }
            
        } else {
            return back()->with('error', 'El producto no existe en el carrito.');
        } 
    }
    public function decrementarCarrito(string $id){
        $item = Detalle_ventas_temporal::find($id);
        if ($item != null) {
            if($item->cantidad > 1){
                $item->cantidad = $item->cantidad - 1;
                $item->total -= $item->precio_unitario;
                $item->save();
                return back();
            }else{
                return back()->with('warning', 'La cantidad no puede disminuir de 1.');
            }
        } else {
            return back()->with('error', 'El producto no existe en el carrito.');
        }
    }
    public function guardarCarrito(Request $request){
        $request->validate([
            "cliente_id" => "required",
        ]);
        $datos = Detalle_ventas_temporal::where('usuario_id', auth()->user()->id)->get();
        $sumaTotal = Detalle_ventas_temporal::selectRaw('SUM(total) AS suma')->where('usuario_id', auth()->user()->id)->first();
        if (count($datos) != 0) {
            try {
                DB::beginTransaction();
                    $item = new Ventas();
                    $item->usuario_id = auth()->user()->id;
                    $item->cliente_id = $request->cliente_id;
                    $item->total = $sumaTotal->suma;
                    $item->save();
                    foreach ($datos as $value) {
                        $item2 = new Detalle_ventas();
                        $item2->venta_id = $item->id;
                        $item2->producto_id = $value->producto_id;
                        $item2->cantidad = $value->cantidad;
                        $item2->precio_unitario = $value->precio_unitario;
                        $item2->total = $value->total;
                        $item2->save();
                        $item3 = Productos::find($value->producto_id);
                        $item3->cantidad -= $value->cantidad;
                        $item3->save();
                    }
                    Detalle_ventas_temporal::where('usuario_id', auth()->user()->id)->delete();
                DB::commit();
                return redirect()->route('ventas.index')->with('success', 'Venta realizada correctamente');
            } catch (\Throwable $th) {
                DB::rollBack();
                return back()->with('error', 'Error: '.$th);
            }
        } else {
            return back()->with('error', 'La tabla carrito debe de tener productos registrados');
        }        
    }
}
