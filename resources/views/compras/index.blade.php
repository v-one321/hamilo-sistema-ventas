@extends('layouts.plantilla')
@section('title-head', 'COMPRAS')
@section('subtitle-head', 'Compras')
@section('contenido')
    <div class="card">
        <div class="card-header bg-indigo">
            <h3 class="card-title">Registros</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @include('includes.alertas')
            <div class="row">
                <div class="col-12 col-md-6 text-center">
                    <a href="{{ route('compras.store') }}" class="btn btn-primary">Agregar<i class="fas fa-plus ml-2"></i></a>
                </div>
                <div class="col-12"><br>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-indigo">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Contacto</th>
                                    <th>Estado</th>
                                    <th>Usuario</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($datos) == 0)
                                    <tr>
                                        <td class="text-center" colspan="6"><span class="badge bg-danger">No tiene registros</span></td>
                                    </tr>
                                @else
                                    @foreach ($datos as $item)
                                        <tr>
                                            <td>{{ $item->proveedores?->nombre }}</td>
                                            <td>{{ $item->proveedores?->apellido }}</td>
                                            <td>{{ $item->proveedores?->contacto }}</td>
                                            <td>
                                                @if ($item->estado)
                                                    <span class="badge bg-success">Activo</span>
                                                @else
                                                    <span class="badge bg-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->usuario?->name }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('compras.show', $item->id) }}" class="btn btn-outline-warning btn-sm"><i class="fa fa-eye"></i></a>
                                                    <form action="{{ route('compras.destroy', $item->id) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        @if ($item->estado)
                                                            <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                        @else
                                                            <button type="submit" class="btn btn-outline-success btn-sm"><i class="fas fa-check"></i></button>
                                                        @endif
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{ $datos->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
