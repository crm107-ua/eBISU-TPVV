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
                          Ordenar por
                      </button>
                          <div class="dropdown-menu" aria-labelledby="sortButton">
                              <h6 class="dropdown-header">Ordenar por</h6>
                              <a class="dropdown-item option" href="{{request()->fullUrlWithQuery(['order'=>'order_date'])}}">Fecha de expiración</a>
                              <a class="dropdown-item option" href="{{request()->fullUrlWithQuery(['order'=>'order_uses'])}}">Nº de usos</a>
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
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="m-5">
                            @foreach($tokens as $token)
                            <tr>
                                <td>{{$token->business->user->name}}</td>
                                <td>{{$token->issuer}} </td>
                                <td><span data-date="{{ $token->expiration_date }}"></span></td>
                                <td>{{$token->times_used}}</td>
                                <td>
                                    <a href="{{route('admin.tokens.invalidate', $token->id)}}" class="mdi mdi-delete-forever mdi-24px"></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $tokens->links('components.pagination', ['paginator'=>$tokens]) }}
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
@endsection
