@extends('layouts.app')
@include('navbar._navbar', ['active' => 'productos','user'=>$user])
@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
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
                        <form method="POST" action="{{route('agregar')}}">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                            @if(in_array($producto->id, $productosEnCarrito))
                                <button type="button" class="btn btn-block btn-success disabled" disabled>
                                    Producto agregado al carrito
                                </button>
                            @else
                                <button type="submit" class="btn btn-block btn-primary">
                                    Agregar al carrito
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
        <div class="row justify-content-center">
            @if($tieneProductosEnCarrito)
                <div class="col-md-6 mt-4">
                    <a href="{{ route('carrito') }}" class="btn btn-success btn-lg btn-block">Ir al carrito</a>
                </div>
            @endif
        </div>
</div>
@endsection
