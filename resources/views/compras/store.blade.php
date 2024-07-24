@extends('layouts.plantilla')
@section('title-head', 'COMPRAS')
@section('subtitle-head', 'Compras')
@section('contenido')
    <div class="container">
        <form action="{{ route('compras.save')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    @include('includes.alertas')
                </div>
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
                                                <td colspan="5" class="text-center"><span class="badge bg-danger">No
                                                        tiene productos registrados</span></td>
                                            </tr>
                                        @else
                                            @foreach ($productos as $item)
                                                <tr>
                                                    <td>{{ $item->nombre }}</td>
                                                    <td>{{ $item->codigo }}</td>
                                                    <td>{{ $item->cantidad }}</td>
                                                    <td>{{ $item->precio_compra }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('compras.agregar-carrito', $item->id) }}"
                                                            class="btn btn-outline-primary btn-sm"><i
                                                                class="fas fa-plus"></i></a>
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
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header bg-indigo">
                            <h5 class="card-title"><i class="fas fa-shopping-cart mr-2"></i>Carrito de compras</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <label for="proveedor_id" class="form-label">Proveedor</label>
                                    <select name="proveedor_id" id="proveedor_id" class="form-control">
                                        <option value="">Seleccione</option>
                                        @foreach ($proveedores as $item)
                                            <option value="{{ $item->id }}">{{ $item->nombre . ' ' . $item->apellido }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('proveedor_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="table-responsive"><br>
                                <table class="table table-hover">
                                    <thead class="bg-indigo">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Codigo</th>
                                            <th>Cantidad</th>
                                            <th>Precio <small class="text-danger">(Unitario)</small></th>
                                            <th>Subtotal</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($carrito) == 0)
                                            <tr>
                                                <td class="text-center" colspan="6"><span class="badge bg-danger">No
                                                        tiene productos registrados</span></td>
                                            </tr>
                                        @else
                                            @foreach ($carrito as $item)
                                                <tr>
                                                    <td>{{ $item->producto?->nombre }}</td>
                                                    <td>{{ $item->producto?->codigo }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{ route('compras.decrementar-carrito', $item->id) }}"
                                                                class="btn btn-danger btn-sm"><i
                                                                    class="fas fa-minus"></i></a>
                                                            <button type="button"
                                                                class="btn btn-primary btn-sm">{{ $item->cantidad }}</button>
                                                            <a href="{{ route('compras.incrementar-carrito', $item->id) }}"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-plus"></i></a>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->precio_unitario }}</td>
                                                    <td>{{ $item->total }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('compras.eliminar-carrito', $item->id) }}"
                                                            class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-center">TOTAL</th>
                                            <th>{{ $sumaTotal->suma }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <a href="{{ route('compras.index') }}" class="btn btn-danger"><i class="fas fa-reply mr-2"></i>Volver</a>
                    <button type="submit" class="btn btn-info">Guardar<i class="fas fa-save ml-2"></i></button>
                </div>
            </div>
        </form>
    </div>
@endsection
