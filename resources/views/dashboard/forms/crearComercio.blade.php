@extends('dashboard.partials.master')
@section('title', 'eBISU Dashboard - Agregar comercio')
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
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title mt-2 mb-5">Dar de alta un comercio</h4>
                  <form class="forms-sample">
                    <div class="row">
                      <!-- Columna 1 -->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputUsername1">CIF:</label>
                          <input type="text" class="form-control" id="cif" name="cif"
                                 style="color: white;" placeholder="CIF">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nombre del representante</label>
                          <input type="email" class="form-control" id="name" name="name"
                                 style="color: white;" placeholder="Nombre del representante">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Contraseña</label>
                          <input type="password" class="form-control" id="password"
                                 name="password" style="color: white;"
                                 placeholder="Contraseña">
                        </div>
                      </div>

                      <!-- Columna 2 -->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputUsername1">Razón social:</label>
                          <input type="text" class="form-control" id="razon" name="razon"
                                 style="color: white;" placeholder="Razon social">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Correo de contacto</label>
                          <input type="email" class="form-control" id="email" name="email"
                                 style="color: white;" placeholder="Correo de contacto">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Teléfono de contacto</label>
                          <input type="text" class="form-control" id="telefono"
                                 name="telefono" style="color: white;"
                                 placeholder="Teléfono de contacto">
                        </div>
                      </div>

                      <!-- Columna 3 -->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputUsername1">Dirección:</label>
                          <input type="text" class="form-control" id="address" name="address"
                                 style="color: white;" placeholder="Dirección">
                        </div>
                        <div class="row">
                          <div class="col-sm-6 form-group">
                            <label for="country">País:</label>
                            <select id="country"
                                    name="country" style="width:100%">
                              <option value="">Selecciona un país</option>
                              @foreach($countries as $country)
                                <option value="{{ $country->code }}"
                                  {{ $country->name == 'Spain' ? 'selected' : '' }}>
                                  {{ $country->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-sm-6 form-group">
                            <label for="city">Población:</label>
                            <select id="poblacion"
                                    name="poblacion" style="width:100%">
                              @foreach($poblations as $poblation)
                                <option
                                  value="{{ $poblation->id }}">{{ $poblation->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Código postal</label>
                          <input type="text" class="form-control" id="cp" name="cp"
                                 style="color: white;" placeholder="Código postal">
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <button type="submit" class="btn btn-success me-2">Darse de alta
                        </button>
                        <button class="btn btn-dark">Cancelar</button>
                      </div>
                      <div class="col">
                        <x-password-generator/>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
    <script defer>
      document.addEventListener('DOMContentLoaded', (event) => {
        const countrySelect = document.getElementById('country');
        const poblacionSelect = document.getElementById('poblacion');

        countrySelect.addEventListener('change', (event) => {
          if (event.target.value !== 'ES') { // Assuming 'ES' is the value for Spain
            poblacionSelect.setAttribute('disabled', '');
          } else {
            poblacionSelect.removeAttribute('disabled');
          }
        });
      });
    </script>
  @endpush
@endsection

