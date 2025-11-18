@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Notes and Reminders</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header fw-bold">
            Formulario para Crear Nota
        </div>

        <div class="card-body">

            <form action="{{ route('notas.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">Seleccionar Usuario</label>
                    <div class="col-md-9">
                        <select name="user_id" class="form-select">
                            @foreach($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">Título Nota</label>
                    <div class="col-md-9">
                        <input type="text" name="titulo" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">Contenido</label>
                    <div class="col-md-9">
                        <textarea name="contenido" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">Fecha Vencimiento</label>
                    <div class="col-md-9">
                        <input type="datetime-local" name="fecha_vencimiento" class="form-control" required>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-4">Añadir Nota</button>
                </div>

            </form>

        </div>
    </div>

    @foreach($users as $user)
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">

                <strong>Usuario: {{ $user->name }}</strong>

                <span class="badge bg-info text-dark">
                    {{ $user->total_notas }} Active Notes
                </span>

            </div>

            <div class="card-body">

                @foreach($user->notas as $nota)
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="card-body">

                            <h5 class="card-title">
                                {{ $nota->titulo }}
                            </h5>

                            <p class="card-text">
                                {{ $nota->contenido }}
                            </p>

                            <p class="mt-2 mb-0">
                                <strong>Due:</strong>
                                @if($nota->recordatorio)
                                    {{ \Carbon\Carbon::parse($nota->recordatorio->fecha_vencimiento)->format('Y-m-d H:i') }}

                                    @if($nota->recordatorio->completado)
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                @else
                                    <span class="badge bg-secondary">Sin recordatorio</span>
                                @endif
                            </p>
                            <div class="mt-3">
                                <h6 class="mb-2" style="font-size: 0.9rem; font-weight: bold;">Actividades:</h6>
                                
                                @if($nota->actividades && $nota->actividades->count() > 0)
                                    
                                    <ul class="list-group list-group-flush">
                                        @foreach($nota->actividades as $actividad)
                                            <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-0 border-0">
                                                
                                                <div class="d-flex align-items-center">
                                                    <form action="{{ route('actividades.toggle', $actividad->id) }}" method="POST" class="d-inline me-2">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm @if($actividad->completada) btn-success @else btn-outline-secondary @endif py-0 px-2">
                                                            ✓
                                                        </button>
                                                    </form>
                                                    
                                                    <span class="@if($actividad->completada) text-decoration-line-through text-muted @endif">
                                                        {{ $actividad->descripcion }}
                                                    </span>
                                                </div>
                                                <div class="d-flex">
                                                    <a href="{{ route('actividades.edit', $actividad->id) }}" class="btn btn-sm btn-outline-primary me-1" style="font-size: 0.7rem;">Editar</a>
                                                    <form action="{{ route('actividades.destroy', $actividad->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta actividad?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" style="font-size: 0.7rem;">X</button>
                                                    </form>
                                                </div>

                                            </li>
                                        @endforeach
                                    </ul>

                                @else
                                    <p class="mb-0 text-muted"><small>No hay actividades para esta nota.</small></p>
                                @endif
                            </div>

                            <hr>
                            <div class="d-flex justify-content-start align-items-center">
                                <a href="{{ route('actividades.create', ['nota_id' => $nota->id]) }}" class="btn btn-sm btn-outline-primary me-2">
                                    + Agregar Actividad
                                </a>
                                <form action="{{ route('notas.destroy', $nota->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar nota? Esto también eliminará su recordatorio y todas sus actividades asociadas.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Eliminar Nota
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @endforeach

</div>
@endsection