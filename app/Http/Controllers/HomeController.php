<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Compras;
use App\Models\Productos;
use App\Models\Ventas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $productos = Productos::where('estado', true)->count();
        $clientes = Clientes::where('estado', true)->count();
        $compras = Compras::where('estado', true)->where('usuario_id', auth()->user()->id)->count();
        $ventas = Ventas::where('estado', true)->where('usuario_id', auth()->user()->id)->count();
        return view('home', compact('productos', 'clientes', 'compras', 'ventas'));
    }
}
