@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- Título general --}}
    <h1 class="text-center mb-4">Notes and Reminders</h1>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulario --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-bold">
            Formulario para Crear Nota
        </div>

        <div class="card-body">

            <form action="{{ route('notas.store') }}" method="POST">
                @csrf

                {{-- Seleccionar usuario --}}
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

                {{-- Titulo --}}
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">Título Nota</label>
                    <div class="col-md-9">
                        <input type="text" name="titulo" class="form-control" required>
                    </div>
                </div>

                {{-- Contenido --}}
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">Contenido</label>
                    <div class="col-md-9">
                        <textarea name="contenido" class="form-control" rows="3" required></textarea>
                    </div>
                </div>

                {{-- Fecha Vencimiento --}}
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">Fecha Vencimiento</label>
                    <div class="col-md-9">
                        <input type="datetime-local" name="fecha_vencimiento" class="form-control" required>
                    </div>
                </div>

                {{-- Botón --}}
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-4">Añadir Nota</button>
                </div>

            </form>

        </div>
    </div>

    {{-- Listado de usuarios --}}
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

                            {{-- Título --}}
                            <h5 class="card-title">
                                {{ $nota->titulo_formateado }}
                            </h5>

                            {{-- Contenido --}}
                            <p class="card-text">
                                {{ $nota->contenido }}
                            </p>

                            {{-- Fecha vencimiento --}}
                            <p class="mt-2 mb-0">
                                <strong>Due:</strong>
                                {{ \Carbon\Carbon::parse($nota->recordatorio->fecha_vencimiento)->format('Y-m-d H:i') }}

                                {{-- Estado --}}
                                @if($nota->recordatorio->completado)
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </p>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @endforeach

</div>
@endsection
