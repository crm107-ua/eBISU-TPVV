@extends('dashboard.partials.master')
@section('title', 'eBISU Dashboard - Detalles administrador')
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
                    <h3 class="card-title mb-0 display-4">Detalles de administrador</h3>
                  </div>
                  <div class="row">
                    <div class="col">
                      <p class="lead"><strong>Nombre:</strong> {{ $admin->name }}</p>
                      <p class="lead"><strong>País:</strong> {{ $admin->country->name }}</p>
                      <p class="lead"><strong>Población:</strong> {{ $admin->direction_poblation }}</p>
                    </div>
                    <div class="col">
                      <p class="lead"><strong>Dirección:</strong> {{ $admin->direction_direction }}</p>
                      <p class="lead"><strong>Código Postal:</strong> {{ $admin->direction_postal_code }}</p>
                    </div>
                  </div>
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <a href="{{route('admin.admins')}}" class="btn btn-lg btn-dark">Volver</a>
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
