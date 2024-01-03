@extends('dashboard.partials.master')
@section('title', 'eBISU Dashboard - Agregar técnico')
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
                  <h4 class="card-title mt-2 mb-5">Registro de técnicos</h4>
                  <form class="forms-sample">
                    <div class="row">

                      <!-- Columna 1 -->
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre</label>
                            <input type="email" class="form-control" id="name" name="name" style="color: white;" placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Correo de contacto</label>
                            <input type="email" class="form-control" id="email" name="email" style="color: white;" placeholder="Correo de contacto">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" style="color: white;"  placeholder="Contraseña">
                        </div>
                      </div>

                      <!-- Columna 3 -->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputUsername1">Dirección:</label>
                          <input type="text" class="form-control" id="address" name="address" style="color: white;"  placeholder="Dirección">
                        </div>
                        <div class="row">
                          <div class="col-sm-6 form-group">
                            <label for="country">País:</label>
                            <select class="js-example-basic-single" id="country" name="country" style="width:100%">
                              <option value="">Selecciona un país</option>
                              <option value="country1">País 1</option>
                              <option value="country2">País 2</option>
                              <option value="country3">País 3</option>
                              <option value="country4">País 4</option>
                              <option value="country5">País 5</option>
                            </select>
                          </div>                          
                          <div class="col-sm-6 form-group">
                            <label for="city">Población:</label>
                            <select class="js-example-basic-single" id="poblacion" name="poblacion" style="width:100%">
                                <option value="">Selecciona un población</option>
                                <option value="AL">Alabama</option>
                                <option value="WY">Wyoming</option>
                                <option value="AM">America</option>
                                <option value="CA">Canada</option>
                                <option value="RU">Russia</option>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Código postal</label>
                            <input type="text" class="form-control" id="cp" name="cp" style="color: white;" placeholder="Código postal">
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success me-2">Registrar</button>
                            <button class="btn btn-dark">Cancelar</button>
                        </div>
                        <div class="col">
                          <x-password-generator/>
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
@endsection
