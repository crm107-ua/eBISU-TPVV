@extends('dashboard.partials.master')
@section('title', 'eBISU Dashboard - Detalles comercio')
@section('content')

  <div class="container-scroller">
    <!-- partial:layouts/nav-lateral.html -->
    @include('dashboard.layouts.nav-lateral')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:layouts/nav-superior.html -->
      @include('dashboard.layouts.nav-superior')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <h3 class="card-title mb-0 display-4">Detalles de comercio</h3>
                  </div>
                  <div class="row">
                    <div class="col">
                      <h4 class="display-4">Información del usuario</h4>
                      <p class="lead"><strong>Nombre:</strong> {{ $business->user->name }}</p>
                      <p class="lead"><strong>Dirección:</strong> {{ $business->user->direction_direction }}</p>
                      <p class="lead"><strong>Código Postal:</strong> {{ $business->user->direction_postal_code }}</p>
                      <p class="lead"><strong>Población:</strong> {{ $business->user->direction_poblation }}</p>
                      <p class="lead"><strong>País:</strong> {{ $business->user->country->name }}</p>
                    </div>
                    <div class="col">
                      <h4 class="display-4">Información del comercio</h4>
                      <p class="lead"><strong>Contacto:</strong> {{ $business->contact_info_name }}</p>
                      <p class="lead"><strong>Email:</strong> {{ $business->contact_info_email }}</p>
                      <p class="lead"><strong>Teléfono:</strong> {{ $business->contact_info_phone_number }}</p>
                      <p class="lead"><strong>CIF:</strong> {{ $business->cif }}</p>
                      <p class="lead"><strong>Fecha de registro:</strong> {{ $business->registration_date }}</p>
                      <p class="lead"><strong>Fecha de baja:</strong> {{ $business->discharge_date }}</p>
                      <p class="lead"><strong>Balance:</strong> {{ $business->balance }}</p>
                    </div>
                  </div>
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <a href="{{route('admin.business')}}" class="btn btn-lg btn-dark">Volver</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <style>
    .display-4 {
      font-size: 1.6rem;
    }
    .lead {
      font-size: 1.1rem;
      font-weight: 600;
    }
  </style>
@endsection
