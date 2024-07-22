@extends('layouts.plantilla')
@section('title-head', 'COMPRAS')
@section('subtitle-head', 'Compras')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header bg-indigo">
                        <h5 class="card-title"><i class="fas fa-cubes mr-2"></i>Productos registrados</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="bg-indigo">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Codigo</th>
                                        <th>Stock</th>
                                        <th>Precio <small class="text-danger">(Compra)</small></th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($productos) == 0)
                                        <tr>
                                            <td colspan="5" class="text-center"><span class="badge bg-danger">No tiene productos registrados</span></td>
                                        </tr>
                                    @else
                                        @foreach ($productos as $item)
                                            <tr>
                                                <td>{{ $item->nombre }}</td>
                                                <td>{{ $item->codigo }}</td>
                                                <td>{{ $item->cantidad }}</td>
                                                <td>{{ $item->precio_compra }}</td>
                                                <td class="text-center">
                                                    <a href="" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $productos->links('pagination::simple-bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection