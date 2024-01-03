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
                  <h3 class="card-title mb-4">Administradores
                    <a type="button" href="/admin-form" class="btn btn-success btn-fw ms-3">Registrar un administrador</a>
                  </h3>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Correo electrónico</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Jacob</td>
                          <td>jacob@example.com</td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ...
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Detalles</a>
                                <a class="dropdown-item" href="#">Editar</a>
                                <a class="dropdown-item" href="#">Borrar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Luis</td>
                          <td>luis@example.com</td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ...
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Detalles</a>
                                <a class="dropdown-item" href="#">Editar</a>
                                <a class="dropdown-item" href="#">Borrar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Carlos</td>
                          <td>carlos@example.com</td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ...
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Detalles</a>
                                <a class="dropdown-item" href="#">Editar</a>
                                <a class="dropdown-item" href="#">Borrar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Pepe</td>
                          <td>pepe@example.com</td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ...
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Detalles</a>
                                <a class="dropdown-item" href="#">Editar</a>
                                <a class="dropdown-item" href="#">Borrar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Jose</td>
                          <td>jose@example.com</td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ...
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Detalles</a>
                                <a class="dropdown-item" href="#">Editar</a>
                                <a class="dropdown-item" href="#">Borrar</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                      <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-5">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                      </nav>
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
