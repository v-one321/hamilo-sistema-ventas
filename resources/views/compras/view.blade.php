@extends('layouts.plantilla')
@section('title-head', 'COMPRAS')
@section('subtitle-head', 'Compras')
@section('contenido')
    <div class="card">
        <div class="card-header bg-indigo">
            <h5 class="card-title"><i class="fas fa-shopping-cart mr-2"></i>Detalle de compra</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <p><b>Nombre: </b> {{ $datos->proveedores?->nombre.' '.$datos->proveedores?->apellido }}</p>
                    <p><b>Identificacion: </b>{{ $datos->proveedores?->identificacion }}</p>
                    <p><b>Contacto: </b>{{ $datos->proveedores?->contacto }}</p>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-indigo">
                                <tr>
                                    <th>Producto</th>
                                    <th>Codigo</th>
                                    <th>Cantidad</th>
                                    <th>Precio <small class="text-danger">(Unitario)</small></th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datos->detalle_compra as $item)
                                    <tr>
                                        <td>{{ $item->producto?->nombre }}</td>
                                        <td>{{ $item->producto?->codigo }}</td>
                                        <td>{{ $item->cantidad }}</td>
                                        <td>{{ $item->precio_unitario }}</td>
                                        <td>{{ $item->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center" colspan="4">TOTAL</th>
                                    <th>{{ $datos->total }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <a href="{{ route('compras.index')}}" class="btn btn-danger">Volver</a>
        </div>
    </div>
@endsection