
@extends('back.layouts.auth-layout')
@section('pageTitle', @isset($pageTitle)?$pageTitle:'Olvidé contraseña')
@section('content')
    

    <div class="page page-center">
        <div class="container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark"><img src="./back/static/logo.svg" height="36" alt=""></a>
        </div>
        @livewire('author-forgot-form')
        <div class="text-center text-muted mt-3">
            Deseo, <a href="{{route('author.login')}}">regresar</a> a la página anterior.
        </div>
        </div>
    </div>


@endsection