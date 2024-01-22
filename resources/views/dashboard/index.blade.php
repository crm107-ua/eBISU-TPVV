@extends('dashboard.partials.master')
@section('title', 'eBISU Dashboard')
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
            <div class="col-sm-4 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5>Total de transacciones</h5>
                  <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                      <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <h2 class="mb-0">{{$totalTransactionsAmount}}€</h2>
                        <p class="text-success ms-2 mb-0 font-weight-medium">en el sistema</p>
                      </div>
                      <h6 class="text-muted font-weight-normal">{{$percentageTransactionsLastMonth}}% Since last month</h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                      <i class="icon-lg mdi mdi-codepen text-primary ms-auto"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-4 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5>Comercios</h5>
                  <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                      <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <h2 class="mb-0">{{$businessesNumber}}</h2>
                        <p class="text-success ms-2 mb-0 font-weight-medium">cuentas de comercio</p>
                      </div>
                      <h6 class="text-muted font-weight-normal"> {{$percentageLastMonth}}% Since last month</h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                      <i class="icon-lg mdi mdi-wallet-travel text-danger ms-auto"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-4 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5 style="display: flex; align-items: center;">
                    <!-- Hacer la estrella más pequeña y alinearla con el título -->
                    <i class="icon-lg mdi mdi-star text-success" style="font-size: 1rem; margin-right: 0.5rem;"></i>Comercios TOP
                  </h5>
                  <div class="row">
                    <!-- Comercio y Cantidad en la misma fila -->
                    <div class="col-6 col-sm-6 col-xl-8 my-auto">
                      <h6 class="text-muted font-weight-normal"><b>Comercio</b></h6>
                    </div>
                    <div class="col-6 col-sm-6 col-xl-4 my-auto text-right">
                      <h6 class="text-muted font-weight-normal"><b>Cantidad</b></h6>
                    </div>
                  </div>
                  <!-- Agregando una pequeña tabla debajo -->
                  <div class="row">
                    <div class="col-12">
                      <table class="table" style="border-spacing: 0; border-collapse: collapse;">
                        <tbody>
                        @foreach($topBusinesses as $business)
                          <tr>
                            <td style="padding: 5px; border-bottom: none;">{{ $business->user->name }}</td>
                            <td style="padding: 5px; border-bottom: none;">{{ $business->total_amount }} €</td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Transacciones</h4>
                  <canvas id="lineChart" style="height: 300px; width: 100%;"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Transacciones por país</h4>
                  <div class="row">
                    <div class="col-md-5">
                      <div class="table-responsive">
                        <table class="table">
                          <tbody>
                            <tr>
                              <td>
                                <i class="flag-icon flag-icon-us"></i>
                              </td>
                              <td>USA</td>
                              <td class="text-right"> 1500 </td>
                            </tr>
                            <tr>
                              <td>
                                <i class="flag-icon flag-icon-de"></i>
                              </td>
                              <td>Germany</td>
                              <td class="text-right"> 800 </td>
                            </tr>
                            <tr>
                              <td>
                                <i class="flag-icon flag-icon-au"></i>
                              </td>
                              <td>Australia</td>
                              <td class="text-right"> 760 </td>
                            </tr>
                            <tr>
                              <td>
                                <i class="flag-icon flag-icon-gb"></i>
                              </td>
                              <td>United Kingdom</td>
                              <td class="text-right"> 450 </td>
                            </tr>
                            <tr>
                              <td>
                                <i class="flag-icon flag-icon-ro"></i>
                              </td>
                              <td>Romania</td>
                              <td class="text-right"> 620 </td>
                            </tr>
                            <tr>
                              <td>
                                <i class="flag-icon flag-icon-br"></i>
                              </td>
                              <td>Brasil</td>
                              <td class="text-right"> 230 </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div id="audience-map" class="vector-map"></div>
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
    window.onload = function() {
      // Obtén el elemento <canvas> por su ID
      var ctx = document.getElementById('lineChart').getContext('2d');

      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: {!! json_encode($monthLabels) !!},
          datasets: [{
            label: 'Ventas',
            data: {!! json_encode($transactionsPerMonth->values()) !!},
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    };
  </script>
@endpush
@endsection
