@extends('layouts.app')

@section('title', 'Inicio de Sesión - Registro')

@section('content')
    <style>
        .bg-custom-color {
            background-color: #9A616D; /* Color personalizado */
        }
    </style>
    <section class="vh-100 bg-custom-color">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                                     alt="Formulario de inicio de sesión" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                            <span class="h1 fw-bold mb-0">WebShop</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Registro de cuenta</h5>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="name" name="nombre" class="form-control form-control-lg @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" />
                                            <label class="form-label" for="name">Nombre</label>
                                            @error('nombre')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="email" name="correo" class="form-control form-control-lg @error('correo') is-invalid @enderror" value="{{ old('correo') }}" />
                                            <label class="form-label" for="email">Correo electrónico</label>
                                            @error('correo')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" />
                                            <label class="form-label" for="password">Contraseña</label>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg" />
                                            <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Registrarse</button>
                                        </div>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">¿Ya tienes una cuenta?
                                            <a href="{{ route('inicio') }}" style="color: #393f81;">Inicia sesión aquí</a></p>
                                        <a href="#!" class="small text-muted">Términos de uso</a>
                                        <a href="#!" class="small text-muted">Política de privacidad</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
