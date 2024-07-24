@extends('layouts.plantilla')
@section('title-head', 'VENTAS')
@section('subtitle-head', 'Ventas')
@section('contenido')
    <div class="card">
        <div class="card-header bg-indigo">
            <h5 class="card-title"><i class="fas fa-shopping-cart mr-2"></i>Detalle de venta</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <p><b>Nombre: </b> {{ $datos->clientes?->nombre.' '.$datos->clientes?->apellido }}</p>
                    <p><b>Identificacion: </b>{{ $datos->clientes?->identificacion }}</p>
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
                                @foreach ($datos->detalle_venta as $item)
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
            <a href="{{ route('ventas.index')}}" class="btn btn-danger">Volver</a>
        </div>
    </div>
@endsection