<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use App\Models\Compras;
use App\Models\Detalle_compras;
use App\Models\Detalle_ventas;
use App\Models\Productos;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function inicio()
    {
        $compras = Compras::where('usuario_id', Auth::id())->where('estado', true)->count();
        $productos = Productos::where('estado', true)->count();
        $ventas = Ventas::where('usuario_id', Auth::id())->where('estado', true)->count();
        $clientes = Clientes::where('estado', true)->count();
        $chartVentas = Detalle_ventas::selectRaw('SUM(detalle_ventas.total) AS total_ventas, productos.nombre AS nombre_producto')
            ->join('productos', 'productos.id', 'detalle_ventas.producto_id')
            ->join('ventas', 'ventas.id', 'detalle_ventas.venta_id')
            ->where('ventas.usuario_id', Auth::id())
            ->where('ventas.estado', true)
            ->groupBy('detalle_ventas.producto_id')
            ->get();
        $chartCompras = Detalle_compras::selectRaw('SUM(detalle_compras.total) AS total_compras, productos.nombre AS nombre_producto')
            ->join('productos', 'productos.id', 'detalle_compras.producto_id')
            ->join('compras', 'compras.id', 'detalle_compras.compra_id')
            ->where('compras.usuario_id', Auth::id())
            ->where('compras.estado', true)
            ->groupBy('detalle_compras.producto_id')
            ->get();
        return response()->json(["mensaje" => "Datos cargados", "totalCompras" => $compras, "totalProductos" => $productos, "totalVentas" => $ventas, "totalClientes" => $clientes, "chartVentas" => $chartVentas, "chartCompras" => $chartCompras], 200);
    }
}
