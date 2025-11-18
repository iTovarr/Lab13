@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">
                    Añadir Nueva Actividad
                </div>
                <div class="card-body">
                    
                    <form action="{{ route('actividades.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nota_id" value="{{ $nota_id }}">

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción de la Actividad</label>
                            <input type="text" 
                                   class="form-control @error('descripcion') is-invalid @enderror" 
                                   id="descripcion" 
                                   name="descripcion" 
                                   value="{{ old('descripcion') }}" 
                                   required>
                            
                            @error('descripcion')
                                <div class="invalid-feedback">
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('notas.index') }}" class="btn btn-secondary me-2">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Guardar Actividad
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection