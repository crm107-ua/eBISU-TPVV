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
                  <h4 class="card-title mt-2 mb-5">Editar un comercio</h4>
                  <form class="forms-sample" action="{{route('admin.business.edit.post', ['id'=>$business->id])}}" method="POST">
                    @csrf
                    <div class="row">
                      <!-- Columna 1 -->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputUsername1">CIF</label>
                          @if($errors->has('cif'))
                            @foreach($errors->get('cif') as $error)
                              <div class="alert alert-danger mt-2">
                                {{ $error }}
                              </div>
                            @endforeach
                          @endif
                          <input type="text" class="form-control" id="cif" name="cif"
                                 style="color: white;" placeholder="CIF" required
                                 value="{{old('cif', $business->cif)}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nombre del representante</label>
                          @if($errors->has('contact-name'))
                            @foreach($errors->get('contact-name') as $error)
                              <div class="alert alert-danger mt-2">
                                {{ $error }}
                              </div>
                            @endforeach
                          @endif
                          <input type="text" class="form-control" id="contact-name" name="contact-name"
                                 style="color: white;" placeholder="Nombre del representante"
                                 value="{{old('contact-name', $business->contact_info_name)}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Contraseña</label>
                          @if($errors->has('password'))
                            @foreach($errors->get('password') as $error)
                              <div class="alert alert-danger mt-2">
                                {{ $error }}
                              </div>
                            @endforeach
                          @endif
                          <input type="password" class="form-control" id="password"
                                 name="password" style="color: white;" required
                                 value="{{old('password', $business->user->password)}}"
                                 placeholder="Contraseña">
                        </div>
                      </div>

                      <!-- Columna 2 -->
                      <div class="col-md-4">
                        <div class="form-group">
                          @if($errors->has('business-name'))
                            @foreach($errors->get('business-name') as $error)
                              <div class="alert alert-danger mt-2">
                                {{ $error }}
                              </div>
                            @endforeach
                          @endif
                          <label for="exampleInputUsername1">Razón social</label>
                          <input type="text" class="form-control" id="business-name" name="business-name"
                                 style="color: white;" placeholder="Razon social" required
                                  value="{{old('business-name', $business->user->name)}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Correo de contacto</label>
                          @if($errors->has('email'))
                            @foreach($errors->get('email') as $error)
                              <div class="alert alert-danger mt-2">
                                {{ $error }}
                              </div>
                            @endforeach
                          @endif
                          <input type="email" class="form-control" id="email" name="email"
                                 style="color: white;" placeholder="Correo de contacto" required
                                 value="{{old('email', $business->contact_info_email)}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Teléfono de contacto</label>
                          @if($errors->has('phone'))
                            @foreach($errors->get('phone') as $error)
                              <div class="alert alert-danger mt-2">
                                {{ $error }}
                              </div>
                            @endforeach
                          @endif
                          <input type="text" class="form-control" id="phone"
                                 name="phone" style="color: white;"
                                 placeholder="Teléfono de contacto"
                                 value="{{old('phone', $business->contact_info_phone_number)}}">
                        </div>
                      </div>

                      <!-- Columna 3 -->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputUsername1">Dirección</label>
                          @if($errors->has('address'))
                            @foreach($errors->get('address') as $error)
                              <div class="alert alert-danger mt-2">
                                {{ $error }}
                              </div>
                            @endforeach
                          @endif
                          <input type="text" class="form-control" id="address" name="address"
                                 style="color: white;" placeholder="Dirección" required
                                  value="{{old('address', $business->user->direction_direction)}}">
                        </div>
                        <div class="row">
                          <div class="col-sm-6 form-group">
                            <label for="country">País</label>
                            @if($errors->has('country'))
                              @foreach($errors->get('country') as $error)
                                <div class="alert alert-danger mt-2">
                                  {{ $error }}
                                </div>
                              @endforeach
                            @endif
                            <select id="country"
                                    name="country" style="width:100%"
                                    required>
                              <option value="">Selecciona un país</option>
                              @foreach($countries as $country)
                                <option value="{{ $country->code }}"
                                  {{ old('country', $business->user->country->code) == $country->code ? 'selected' : '' }}>
                                  {{ $country->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-sm-6 form-group">
                            <label for="town">Población</label>
                            <p>{{$business->user->direction_poblation}}</p>
                            <select id="town" name="town" style="width:100%">
                              @foreach($poblations as $poblation)
                                <option value="{{ $poblation->name }}"
                                  {{ old('town', $business->user->direction_poblation) == $poblation->name ? 'selected' : '' }}>
                                  {{ $poblation->name }}
                                </option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Código postal</label>
                          @if($errors->has('cp'))
                            @foreach($errors->get('cp') as $error)
                              <div class="alert alert-danger mt-2">
                                {{ $error }}
                              </div>
                            @endforeach
                          @endif
                          <input type="text" class="form-control" id="cp" name="cp"
                                 style="color: white;" placeholder="Código postal" required
                                 value="{{old('cp', $business->user->direction_postal_code)}}">
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <button type="submit" class="btn btn-success me-2">
                          Dar de alta
                        </button>
                        <a href="{{route('admin.business')}}" class="btn btn-dark">Cancelar</a>
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
        const poblacionSelect = document.getElementById('town');

        countrySelect.addEventListener('change', (event) => {
          if (event.target.value !== 'ES') {
            poblacionSelect.setAttribute('disabled', '');
          } else {
            poblacionSelect.removeAttribute('disabled');
          }
        });
      });
    </script>
  @endpush
@endsection

