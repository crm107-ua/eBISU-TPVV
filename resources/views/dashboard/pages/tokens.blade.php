@extends('dashboard.partials.master')
@section('title', 'eBISU Dashboard - API Tokens')
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
                    <h3 class="card-title mb-0">API Tokens</h3>        
                    <div class="dropdown mb-3">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="sortButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Ordenar por: CIF
                      </button>
                          <div class="dropdown-menu" aria-labelledby="sortButton">
                              <h6 class="dropdown-header">Ordenar por:</h6>
                              <a class="dropdown-item option" href="#">CIF</a>
                              <a class="dropdown-item option" href="#">Nombre</a>
                              <a class="dropdown-item option" href="#">Fecha</a>
                          </div>
                      </div>        
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table" style="color: azure">
                        <thead>
                            <tr>
                                <th>Razón social</th>
                                <th>Issuer</th>
                                <th>Fecha de expiración</th>
                                <th>Veces usado</th>
                                <th>Token</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="m-5">
                            <tr>
                                <td>Atlas SA</td>
                                <td>Rafael Perez </td>
                                <td>12/12/2023</td>
                                <td>435</td>
                                <td class="token">dfskjfklsdjfj6f7ds687f6sd87</td>
                                <td>
                                    <a href="#" class="mdi mdi-delete-forever mdi-24px"></a>
                                    <a href="#" class="mdi mdi-content-copy mdi-24px" onclick="copyToClipboard(this)"></a> <!-- Add onclick event here -->
                                </td>
                            </tr> 
                            <tr>
                                <td>Atlas SA</td>
                                <td>Rafael Perez </td>
                                <td>12/12/2023</td>
                                <td>435</td>
                                <td class="token">dfskjfklsdjfj6f7ds687f6sd87</td>
                                <td>
                                    <a href="#" class="mdi mdi-delete-forever mdi-24px"></a>
                                    <a href="#" class="mdi mdi-content-copy mdi-24px" onclick="copyToClipboard(this)"></a> <!-- Add onclick event here -->
                                </td>
                            </tr> 
                            <tr>
                                <td>Atlas SA</td>
                                <td>Rafael Perez </td>
                                <td>12/12/2023</td>
                                <td>435</td>
                                <td class="token">dfskjfklsdjfj6f7ds66666d87</td>
                                <td>
                                    <a href="#" class="mdi mdi-delete-forever mdi-24px"></a>
                                    <a href="#" class="mdi mdi-content-copy mdi-24px" onclick="copyToClipboard(this)"></a> <!-- Add onclick event here -->
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