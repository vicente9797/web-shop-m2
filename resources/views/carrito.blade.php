@extends('layouts.app')
@include('navbar._navbar', ['active' => 'carrito','user'=>$user])
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
            @foreach($productos as $producto)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="{{ $producto->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->name }}</h5>
                            <p class="card-text">{{ $producto->description }}</p>
                            <p class="card-text"><strong>Precio: </strong>${{ $producto->precio }}</p>
                            <form method="POST" action="{{route('eliminar')}}">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                <button type="submit" class="btn btn-danger btn-block">
                                    Eliminar del carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            @if(empty($producto))
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        No hay productos en el carrito
                    </div>
                </div>
           @endif
        </div>
            @if(!empty($producto))
                <div class="col-12">
                    <form method="POST" action="{{ route('generar-orden') }}">
                        @csrf
                        @foreach($productos as $producto)
                            <input type="hidden" name="producto_id[]" value="{{ $producto->id }}">
                        @endforeach
                        <button type="submit" class="btn btn-success btn-block">Generar Pago</button>
                    </form>
                </div>
            @endif
    </div>
@endsection
