@extends('layout.app')
@section('content')
<div id="content" class="container text-center">
    <!-- Título -->
    <h2 class="text-success mb-4">
        Bienvenido a <img src="{{ asset('/images/logo.png') }}" height="100">
    </h2>

    <!-- Descripción de la aplicación -->
    <p class="lead text-muted mb-3">
        Gestiona fácilmente empleados, productos y pedidos desde un solo lugar.
    </p>

    <!-- Funcionalidades principales -->
    <p class="text-secondary mb-3">
        Accede al listado de productos, da de alta nuevos empleados y administra los pedidos de tu almacén de manera sencilla y segura.
    </p>

    <!-- Invitación a iniciar sesión -->
    <p class="text-info mb-3">
        Para comenzar, inicia sesión con tu cuenta. Si no tienes acceso, contacta con el administrador.
    </p>
</div>
@endsection
