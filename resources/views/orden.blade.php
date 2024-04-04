@extends('layouts.app')
@include('navbar._navbar', ['active' => 'ordenes', 'user' => $user])
@section('content')
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
        <div class="row">
            <div class="col-md-12">
                <h2>Órdenes</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Número de Transacción</th>
                        <th>Nombre de la Persona</th>
                        <th>Fecha de Orden</th>
                        <th>Total Compra</th>
                        <th>Ver Detalles</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ordenes as $orden)
                        <tr>
                            <td>{{ $orden->transaction_number }}</td>
                            <td>{{ $user->name }}</td>
                            <td> {{$orden->created_at}}</td>
                            <td>$ {{$orden->total}}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#orden{{ $orden->id }}">
                                    Ver Detalles
                                </button>
                            </td>
                        </tr>
                        <div class="modal fade" id="orden{{ $orden->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detalles de la Orden {{ $orden->transaction_number }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            @foreach($orden->detalles as $detalle)
                                                <li>{{ $detalle->name }} ({{ $detalle->cantidad }}) - Precio Unitario: {{$detalle->precio}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
