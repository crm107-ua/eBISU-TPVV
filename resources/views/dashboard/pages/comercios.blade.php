@extends('dashboard.partials.master')
@section('title', 'eBISU Dashboard - Comercios')
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
                    <h3 class="card-title mb-0">Comercios</h3>
                      <div class="d-flex justify-content-end">
                        <a type="button" href="/admin-form" class="btn btn-success mb-2 mt-2">Crear comercio</a>
                          <div class="dropdown me-2">
                              <button class="btn btn-secondary dropdown-toggle ms-3 m-2" type="button" id="sortButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Exportar datos:
                              </button>
                              <div class="dropdown-menu">
                                  <h6 class="dropdown-header">Tipo de exportación:</h6>
                                  <a class="dropdown-item" href="#">Opcion 1</a>
                                  <a class="dropdown-item" href="#">Opcion 2</a>
                                  <a class="dropdown-item" href="#">Opcion 3</a>
                              </div>
                          </div>             
                          <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle ms-1 m-2" type="button" id="sortButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Ordenar por:
                              </button>
                              <div class="dropdown-menu" aria-labelledby="sortButton">
                                  <h6 class="dropdown-header">Tipo de ordenación:</h6>
                                  <a class="dropdown-item option" href="#">Opcion 1</a>
                                  <a class="dropdown-item option" href="#">Opcion 2</a>
                                  <a class="dropdown-item option" href="#">Opcion 3</a>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table mt-3" style="color: white;">
                      <thead>
                        <tr>
                          <th>Razón social</th>
                          <th>Responsable</th>
                          <th>Correo electrónico</th>
                          <th>Teléfono</th>
                          <th>Fecha de registro</th>
                          <th>CIF</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Atlas S.A</td>
                          <td>Carlos Navas</td>
                          <td>crm111ua@alu.ua.es</td>
                          <td>965 90 34 56</td>
                          <td>12/05/2021</td>
                          <td>A12345678</td>
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
                          <td>Atlas S.A</td>
                          <td>Carlos Navas</td>
                          <td>crm111ua@alu.ua.es</td>
                          <td>965 90 34 56</td>
                          <td>12/05/2021</td>
                          <td>A12345678</td>
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
                          <td>Atlas S.A</td>
                          <td>Carlos Navas</td>
                          <td>crm111ua@alu.ua.es</td>
                          <td>965 90 34 56</td>
                          <td>12/05/2021</td>
                          <td>A12345678</td>
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
                          <td>Atlas S.A</td>
                          <td>Carlos Navas</td>
                          <td>crm111ua@alu.ua.es</td>
                          <td>965 90 34 56</td>
                          <td>12/05/2021</td>
                          <td>A12345678</td>
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
