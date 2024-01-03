@extends('dashboard.partials.master')
@section('title', 'eBISU Dashboard - Incidencias')
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
                    <h3 class="card-title mb-0">Incidencias</h3>        
                        <div class="d-flex justify-content-end">

                            <div class="col-sm-9">
                                <input class="form-control m-1" placeholder="Fecha de creación: dd/mm/yyyy" />
                            </div>
                        
                            <div class="dropdown me-2">
                                <button class="btn btn-secondary dropdown-toggle ms-4 m-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Estado</button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <h6 class="dropdown-header">Estado actual:</h6>
                                    <a class="dropdown-item" href="#">Opcion 1</a>
                                    <a class="dropdown-item" href="#">Opcion 2</a>
                                    <a class="dropdown-item" href="#">Opcion 3</a>
                                </div>
                            </div>
                        
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle ms-1 m-2" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Asignación</button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <h6 class="dropdown-header">Persona asignada:</h6>
                                    <a class="dropdown-item" href="#">Opcion 1</a>
                                    <a class="dropdown-item" href="#">Opcion 2</a>
                                    <a class="dropdown-item" href="#">Opcion 3</a>
                                </div>
                            </div>
                        </div>         
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Creador</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="m-5">
                            <tr>
                                <td>Rafael Perez (Atlas SA)</td>
                                <td>Problema con los pagos por paypal</td>
                                <td>Nuestros clientes no pueden realizar los pagos por paypal...</td>
                                <td><label class="badge badge-danger">Pendiente</label></td>
                                <td>12/12/2023</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">Ver más</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Rafael Perez (Atlas SA)</td>
                                <td>Problema con los pagos por paypal</td>
                                <td>Nuestros clientes no pueden realizar los pagos por paypal...</td>
                                <td><label class="badge badge-danger">Pendiente</label></td>
                                <td>12/12/2023</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">Ver más</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Rafael Perez (Atlas SA)</td>
                                <td>Problema con los pagos por paypal</td>
                                <td>Nuestros clientes no pueden realizar los pagos por paypal...</td>
                                <td><label class="badge badge-danger">Pendiente</label></td>
                                <td>12/12/2023</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">Ver más</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Rafael Perez (Atlas SA)</td>
                                <td>Problema con los pagos por paypal</td>
                                <td>Nuestros clientes no pueden realizar los pagos por paypal...</td>
                                <td><label class="badge badge-danger">Pendiente</label></td>
                                <td>12/12/2023</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">Ver más</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                        <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-4">
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
