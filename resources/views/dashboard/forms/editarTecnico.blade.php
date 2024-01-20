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
                  <h4 class="card-title mt-2 mb-5">Edicción de técnicos</h4>
                  <form class="forms-sample" action="{{route('admin.technicians.edit.post', $technician->id)}}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="name">Nombre</label>
                          @if($errors->has('name'))
                            @foreach($errors->get('name') as $error)
                              <div class="alert alert-danger mt-2">
                                {{ $error }}
                              </div>
                            @endforeach
                          @endif
                          <input type="text" class="form-control" id="name" name="name"
                                 style="color: white;" placeholder="Nombre"
                                 value="{{old('name', $technician->name)}}">
                        </div>

                        <div class="form-group">
                          <label for="email">Correo de contacto</label>
                          @if($errors->has('email'))
                            @foreach($errors->get('email') as $error)
                              <div class="alert alert-danger mt-2">
                                {{ $error }}
                              </div>
                            @endforeach
                          @endif
                          <input type="email" class="form-control" id="email" name="email"
                                 style="color: white;" placeholder="Correo de contacto" required
                                 value="{{old('email', $technician->email)}}">
                        </div>

                        <div class="form-group">
                          <label for="password">Contraseña</label>
                          @if($errors->has('password'))
                            @foreach($errors->get('password') as $error)
                              <div class="alert alert-danger mt-2">
                                {{ $error }}
                              </div>
                            @endforeach
                          @endif
                          <input type="password" class="form-control" id="password"
                                 name="password" style="color: white;" required
                                 value="{{old('password', $technician->password)}}"
                                 placeholder="Contraseña">
                        </div>
                      </div>

                      <!-- Columna 3 -->
                      <div class="col-md-6">
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
                                 style="color: white;" placeholder="Dirección"
                                 value="{{old('address', $technician->direction_direction)}}" required>
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
                                  {{ old('country', $technician->country->code) == $country->code ? 'selected' : '' }}>
                                  {{ $country->name }}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="col-sm-6 form-group">
                            <label for="town">Población</label>
                            @if($errors->has('town-select'))
                              @foreach($errors->get('town-select') as $error)
                                <div class="alert alert-danger mt-2">
                                  {{ $error }}
                                </div>
                              @endforeach
                            @endif
                            @if($errors->has('town-input'))
                              @foreach($errors->get('town-input') as $error)
                                <div class="alert alert-danger mt-2">
                                  {{ $error }}
                                </div>
                              @endforeach
                            @endif
                            <p>{{$technician->direction_poblation}}</p>
                            <select id="town-select"
                                    name="town-select" style="width:100%; display: inline">
                              @foreach($poblations as $poblation)
                                <option
                                  value="{{ $poblation->name }}"
                                  {{ old('town-select') == $poblation->name ? 'selected' : '' }}>
                                  {{ $poblation->name }}
                                </option>
                              @endforeach
                            </select>
                            <input type="text" class="form-control" id="town-input"
                                   name="town-input" style="color: white; display: none"
                                   placeholder="Ciudad o pueblo"
                                   value="{{old('town-input', $technician->direction_poblation)}}">
                          </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="cp">Código postal</label>
                          @if($errors->has('cp'))
                            @foreach($errors->get('cp') as $error)
                              <div class="alert alert-danger mt-2">
                                {{ $error }}
                              </div>
                            @endforeach
                          @endif
                          <input type="text" class="form-control" id="cp" name="cp"
                                 style="color: white;" placeholder="Código postal"
                                 value="{{old('cp', $technician->direction_postal_code)}}" required>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <button type="submit" class="btn btn-success me-2">Modificar</button>
                        <a class="btn btn-dark" href="{{route('admin.admins')}}">Cancelar</a>
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
      const poblacionSelect = document.getElementById('town-select');
      const poblacionInput = document.getElementById('town-input')

      const countrySessionValue = "{{ session('country', 'ES') }}";
      console.log(countrySessionValue);

      if (countrySessionValue !== 'ES') {
        poblacionSelect.style.display = 'none';
        poblacionInput.style.display = 'inline';
      } else {
        poblacionSelect.style.display = 'inline';
        poblacionInput.style.display = 'none';
      }

      countrySelect.addEventListener('change', (event) => {
        if (event.target.value === 'ES') {
          poblacionSelect.style.display = 'inline';
          poblacionInput.style.display = 'none';
        } else {
          poblacionSelect.style.display = 'none';
          poblacionInput.style.display = 'inline';
        }
      });
    });
  </script>
@endpush
@endsection
