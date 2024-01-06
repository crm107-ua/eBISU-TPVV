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
                      <a type="button" href="{{ route('admin.business.create') }}" class="btn btn-success mb-2 mt-2">Crear
                        comercio</a>
                      <div class="dropdown me-2">
                        <button class="btn btn-secondary dropdown-toggle ms-3 m-2" type="button" id="sortButton"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <button class="btn btn-secondary dropdown-toggle ms-1 m-2" type="button" id="sortButton"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                      @foreach($businessList as $business)
                        <tr>
                          <td>{{ $business->user->name }}</td>
                          <td>{{ $business->contact_info_name }}</td>
                          <td>{{ $business->contact_info_email }}</td>
                          <td>{{ $business->contact_info_phone_number }}</td>
                          <td>{{ $business->registration_date }}</td>
                          <td>{{ $business->cif }}</td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button"
                                      id="dropdownMenuButton" data-bs-toggle="dropdown"
                                      aria-haspopup="true" aria-expanded="false">
                                Acción
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('admin.business.details', $business->id)}}">Detalles</a>
                                <a class="dropdown-item" href="{{route('admin.business.edit', $business->id)}}">Editar</a>
                                @if($business->discharge_date == null)
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                   data-bs-target="#confirmModal"
                                   onclick="storeUrl('{{route('admin.business.discharge', $business->id)}}')">
                                  Dar de baja</a>
                                @else
                                  <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                     data-bs-target="#confirmModal"
                                     onclick="storeUrl('{{route('admin.business.activate', $business->id)}}')">
                                    Activar comercio</a>
                                @endif
                              </div>
                              <!-- Modal -->
                              <div class="modal fade" id="confirmModal" tabindex="-1"
                                   aria-labelledby="confirmModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="confirmModalLabel">Confirmación</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal"
                                              aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      @if($business->discharge_date == null)
                                        ¿Estás seguro de que quieres dar de baja este comercio?
                                      @else
                                        ¿Estás seguro de que quieres activar este comercio?
                                      @endif
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar
                                      </button>
                                      <button type="button" class="btn btn-primary" id="confirmYes">
                                        @if($business->discharge_date == null)
                                          Sí, dar de baja
                                        @else
                                          Sí, activar comercio
                                        @endif
                                      </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                    {{ $businessList->links('components.pagination', ['paginator'=>$businessList]) }}
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
  @push('scripts')
    <script>
      var url;

      function storeUrl(route) {
        url = route;
      }

      document.addEventListener('DOMContentLoaded', (event) => {
        var confirmYes = document.getElementById('confirmYes');

        confirmYes.onclick = function () {
          window.location.href = url;
        }
      });
    </script>
  @endpush

@endsection

