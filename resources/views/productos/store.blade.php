@extends('layouts.plantilla')
@section('title-head', 'PRODUCTOS')
@section('subtitle-head', 'Productos')
@section('contenido')
    <div class="card">
        <div class="card-header bg-indigo">
            <h5 class="card-title"><i class="fas fa-edit mr-2"></i>Nuevo registro</h5>
        </div>
        <form action="{{ route('productos.store') }}" method="post" class="needs-validation" novalidate autocomplete="off">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{ old('nombre') }}"
                            required>
                        @error('nombre')
                            <small class="text-danger"><i class="fas fa-times mr-1"></i>{{ $message }}</small>
                        @enderror
                        <div class="valid-feedback">
                            <i class="fas fa-check mr-1"></i>Bien!
                        </div>
                        <div class="invalid-feedback">
                            <i class="fas fa-times mr-1"></i>Debe llenar este campo!
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="codigo" class="form-label">Codigo</label>
                        <input type="text" class="form-control" name="codigo" id="codigo" value="{{ old('codigo') }}" required>
                        @error('codigo')
                            <small class="text-danger"><i class="fas fa-times mr-1"></i>{{ $message }}</small>
                        @enderror
                        <div class="valid-feedback">
                            <i class="fas fa-check mr-1"></i>Bien!
                        </div>
                        <div class="invalid-feedback">
                            <i class="fas fa-times mr-1"></i>Debe llenar este campo!
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="precio_compra" class="form-label">Precio <small class="text-danger">(Compra)</small></label>
                        <input type="text" class="form-control" name="precio_compra" id="precio_compra"
                            value="{{ old('precio_compra') }}" required>
                        @error('precio_compra')
                            <small class="text-danger"><i class="fas fa-times mr-1"></i>{{ $message }}</small>
                        @enderror
                        <div class="valid-feedback">
                            <i class="fas fa-check mr-1"></i>Bien!
                        </div>
                        <div class="invalid-feedback">
                            <i class="fas fa-times mr-1"></i>Debe llenar este campo!
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="precio_venta" class="form-label">Precio <small class="text-danger">(Venta)</small></label>
                        <input type="text" class="form-control" name="precio_venta" id="precio_venta"
                            value="{{ old('precio_venta') }}" required>
                        @error('precio_venta')
                            <small class="text-danger"><i class="fas fa-times mr-1"></i>{{ $message }}</small>
                        @enderror
                        <div class="valid-feedback">
                            <i class="fas fa-check mr-1"></i>Bien!
                        </div>
                        <div class="invalid-feedback">
                            <i class="fas fa-times mr-1"></i>Debe llenar este campo!
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <small class="text-danger"><i class="fas fa-times mr-1"></i>{{ $message }}</small>
                        @enderror
                        <div class="valid-feedback">
                            <i class="fas fa-check mr-1"></i>Bien!
                        </div>
                        <div class="invalid-feedback">
                            <i class="fas fa-times mr-1"></i>Debe llenar este campo!
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('productos.index') }}" class="btn btn-danger"><i class="fas fa-reply mr-2"></i>Volver</a>
                <button type="submit" class="btn btn-info">Guardar<i class="fas fa-save ml-2"></i></button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection
