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
                                <button class="btn btn-secondary dropdown-toggle ms-4 m-2" type="button" id="sortButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Estado
                                </button>
                                <div class="dropdown-menu" aria-labelledby="sortButton">
                                    <h6 class="dropdown-header">Estado actual:</h6>
                                    <a class="dropdown-item option" href="#">Opcion 1</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle ms-1 m-2" type="button" id="sortButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Asignación
                                </button>
                                <div class="dropdown-menu" aria-labelledby="sortButton">
                                    <h6 class="dropdown-header">Persona asignada:</h6>
                                    <a class="dropdown-item option" href="#">Opcion 1</a>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table" style="color: white">
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
                            @foreach($tickets as $ticket)
                              <tr>
                                <td>{{$ticket->transaction->business->contact_info_name}} ({{$ticket->transaction->business->user->name}})</td>
                                <td>{{$ticket->title}}</td>
                                <td>{{$ticket->description}}</td>
                                <td>
                                  @if($ticket->state == 'open')
                                    <label class="badge badge-danger">Abierto</label>
                                  @elseif($ticket->state == 'resolving')
                                    <label class="badge badge-primary">Resolviendo</label>
                                  @elseif($ticket->state == 'closed')
                                    <label class="badge badge-success">Resuelto</label>
                                  @endif
                                </td>
                                <td>{{ date('d/m/Y', strtotime($ticket->creation_date)) }}</td>
                                <td>
                                    <a href="{{route('admin.tickets.details', ['id'=>$ticket->id])}}" class="btn btn-primary btn-sm">Ver más</a>
                                </td>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $tickets->links('components.pagination', ['paginator'=>$tickets]) }}
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
