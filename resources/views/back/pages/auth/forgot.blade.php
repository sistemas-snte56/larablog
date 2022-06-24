
@extends('back.layouts.auth-layout')
@section('pageTitle', @isset($pageTitle)?$pageTitle:'Olvidé contraseña')
@section('content')
    

    <div class="page page-center">
        <div class="container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark"><img src="./back/static/logo.svg" height="36" alt=""></a>
        </div>
        <form class="card card-md" action="." method="get">
            <div class="card-body">
            <h2 class="card-title text-center mb-4">Se te olvidó tu contraseña</h2>
            <p class="text-muted mb-4">Ingrese su correo electrónico y su contraseña se restablecerá y se le enviará por correo electrónico.</p>
            <div class="mb-3">
                <label class="form-label">Dirección de correo electrónico</label>
                <input type="email" class="form-control" placeholder="Ingresa correo">
            </div>
            <div class="form-footer">
                <a href="#" class="btn btn-primary w-100">
                <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="5" width="18" height="14" rx="2"></rect><polyline points="3 7 12 13 21 7"></polyline></svg>
                Enviarme nueva contraseña
                </a>
            </div>
            </div>
        </form>
        <div class="text-center text-muted mt-3">
            
            
            Deseo, <a href="{{route('author.login')}}">regresar</a> a la página anterior.
        </div>
        </div>
    </div>


@endsection