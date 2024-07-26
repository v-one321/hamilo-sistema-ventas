@extends('layouts.plantilla')
@section('title-head', 'DASHBOARD')
@section('subtitle-head', 'Dashboard')
@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-12 col-md-7">
                            <span class="h5">Total Clientes <b>{{ $clientes }}</b></span>
                        </div>
                        <div class="col-12 col-md-5 display-2">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-12 col-md-7">
                            <span class="h5">Total Productos <b>{{ $productos }}</b></span>
                        </div>
                        <div class="col-12 col-md-5 display-2">
                            <i class="fas fa-cubes"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-12 col-md-7">
                            <span class="h5">Total Compras <b>{{ $compras }}</b></span>
                        </div>
                        <div class="col-12 col-md-5 display-2">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-12 col-md-7">
                            <span class="h5">Total Ventas <b>{{ $ventas }}</b></span>
                        </div>
                        <div class="col-12 col-md-5 display-2">
                            <i class="fas fa-cash-register"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card border-0 bg-info-subtle">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-info">
                            <i class="fas fa-shopping-cart me-2"></i>Productos mas vendidos
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                            Celular
                            <span class="badge text-bg-primary rounded-pill">5</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                            Televisor
                            <span class="badge text-bg-primary rounded-pill">10</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                            Lavadora
                            <span class="badge text-bg-primary rounded-pill">2</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card bg-danger-subtle">
                <div class="card-body text-center">
                    <h4 class="card-title">
                        Estadisticas
                    </h4>
                    <i class="fas fa-chart-pie text-danger" style="font-size: 17vw;"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection