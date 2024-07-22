@extends('layouts.plantilla')
@section('title-head', 'PROVEEDORES')
@section('subtitle-head', 'Proveedores')
@section('contenido')
    <div class="card">
        <div class="card-header bg-indigo">
            <h5 class="card-title"><i class="fas fa-edit mr-2"></i>Nuevo registro</h5>
        </div>
        <form action="{{ route('proveedores.store') }}" method="post" class="needs-validation" novalidate autocomplete="off">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-3">
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
                    <div class="col-12 col-md-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="apellido" id="apellido" value="{{ old('apellido') }}">
                        @error('apellido')
                            <small class="text-danger"><i class="fas fa-times mr-1"></i>{{ $message }}</small>
                        @enderror
                        <div class="valid-feedback">
                            <i class="fas fa-check mr-1"></i>Bien!
                        </div>
                        <div class="invalid-feedback">
                            <i class="fas fa-times mr-1"></i>Debe llenar este campo!
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="identificacion" class="form-label">Identificacion</label>
                        <input type="text" class="form-control" name="identificacion" id="identificacion"
                            value="{{ old('identificacion') }}" required>
                        @error('identificacion')
                            <small class="text-danger"><i class="fas fa-times mr-1"></i>{{ $message }}</small>
                        @enderror
                        <div class="valid-feedback">
                            <i class="fas fa-check mr-1"></i>Bien!
                        </div>
                        <div class="invalid-feedback">
                            <i class="fas fa-times mr-1"></i>Debe llenar este campo!
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="contacto" class="form-label">Contacto</label>
                        <input type="text" class="form-control" name="contacto" id="contacto"
                            value="{{ old('contacto') }}" required>
                        @error('contacto')
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
                <a href="{{ route('proveedores.index') }}" class="btn btn-danger"><i class="fas fa-reply mr-2"></i>Volver</a>
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
