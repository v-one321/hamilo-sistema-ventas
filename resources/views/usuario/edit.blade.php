@extends('layouts.plantilla')
@section('title-head', 'USUARIO')
@section('subtitle-head', 'Usuario')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('includes.alertas')
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header bg-indigo">
                        <h5 class="card-title"><i class="fas fa-user mr-2"></i>Datos del usuario</h5>
                    </div>
                    <form action="{{ route('usuario.editar-datos') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-center">                                    
                                    <img src="{{ $item->foto_perfil ? asset('fotos/'.$item->foto_perfil) : 'plantilla_admin/dist/img/user2-160x160.jpg'}}" width="120px" height="120px" class="img-circle elevation-2" alt="User Image">
                                </div>
                                <div class="col-12 col-md-6"><br>
                                    <label for="name" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $item->name) }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6"><br>
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $item->email) }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="foto_perfil" class="form-label">Foto perfil</label>
                                    <input type="file" class="form-control" name="foto_perfil" id="foto_perfil" value="{{ old('foto_perfil') }}" >
                                    @error('foto_perfil')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-info">Actualizar<i class="fas fa-save ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header bg-indigo">
                        <h5 class="card-title"><i class="fas fa-user mr-2"></i>Modificar contraseña</h5>
                    </div>
                    <form action="{{ route('usuario.editar-password') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="text" class="form-control" name="password" id="password" value="{{ old('password') }}">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="password_confirmation" class="form-label">Repita contraseña</label>
                                    <input type="password_confirmation" class="form-control" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}">
                                    @error('password_confirmation')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-warning">Actualizar<i class="fas fa-save ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection