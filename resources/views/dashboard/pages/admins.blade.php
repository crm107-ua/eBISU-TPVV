@extends('dashboard.partials.master')
@section('title', 'eBISU Dashboard - Administradores')
@section('content')
<style>
  /* Estilos aquí */
  .dropdown-menu a:hover {
      opacity: 1 !important;
      color: #fff !important;
      background-color: #007bff !important;
  }
</style>

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
                  <h3 class="card-title mb-4">
                    Administradores
                    <a type="button" href="{{route('admin.admins.create')}}"
                       class="btn btn-success btn-fw ms-3">
                        Registrar un administrador</a>
                  </h3>
                  <div class="table-responsive">
                    <table class="table" style="color: white">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Correo electrónico</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($admins as $admin)
                          <tr>
                            <td>{{$admin->name}}</td>
                            <td>{{$admin->email}}</td>
                            <td>
                              <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Acción
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="{{route('admin.admins.details', $admin->id)}}">Detalles</a>
                                  <a class="dropdown-item" href="#">Editar</a>
                                  <a class="dropdown-item" href="#">Borrar</a>
                                </div>
                              </div>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{ $admins->links('components.pagination', ['paginator'=>$admins]) }}
                    <div>
                      @if (session('success'))
                        <div class="alert alert-success">
                          {{ session('success') }}
                        </div>
                      @endif

                      @if ($errors->any())
                        <div class="alert alert-danger">
                          @foreach ($errors->all() as $error)
                            {{ $error }}
                          @endforeach
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
