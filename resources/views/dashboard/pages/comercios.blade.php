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
                    <div class="dropdown mb-3">
                      <a type="button" href="/comercios-form" class="btn btn-success btn-fw">Añadir comercio</a>
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Exportar datos</button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                        <h6 class="dropdown-header">Settings</h6>
                        <a class="dropdown-item" href="#">Opcion 1</a>
                        <a class="dropdown-item" href="#">Opcion 2</a>
                        <a class="dropdown-item" href="#">Opcion 3</a>
                      </div>
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ordenar por: CIF</button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                        <h6 class="dropdown-header">Settings</h6>
                        <a class="dropdown-item" href="#">Opcion 1</a>
                        <a class="dropdown-item" href="#">Opcion 2</a>
                        <a class="dropdown-item" href="#">Opcion 3</a>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Profile</th>
                          <th>VatNo.</th>
                          <th>Created</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Jacob</td>
                          <td>53275531</td>
                          <td>12 May 2017</td>
                          <td><label class="badge badge-danger">Pending</label></td>
                        </tr>
                        <tr>
                          <td>Messsy</td>
                          <td>53275532</td>
                          <td>15 May 2017</td>
                          <td><label class="badge badge-warning">In progress</label></td>
                        </tr>
                        <tr>
                          <td>John</td>
                          <td>53275533</td>
                          <td>14 May 2017</td>
                          <td><label class="badge badge-info">Fixed</label></td>
                        </tr>
                        <tr>
                          <td>Peter</td>
                          <td>53275534</td>
                          <td>16 May 2017</td>
                          <td><label class="badge badge-success">Completed</label></td>
                        </tr>
                        <tr>
                          <td>Dave</td>
                          <td>53275535</td>
                          <td>20 May 2017</td>
                          <td><label class="badge badge-warning">In progress</label></td>
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
