@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Tarjeta del Post --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h2 class="card-title text-primary fw-bold">{{ $post->title }}</h2>
            <p class="card-text fs-5 mt-3">{{ $post->content }}</p>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="d-flex align-items-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=0D8ABC&color=fff&rounded=true" 
                         alt="Avatar" class="rounded-circle me-2" width="40" height="40">
                    <small class="text-muted">Publicado por <strong>{{ $post->user->name }}</strong></small>
                </div>
                <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary btn-sm">← Volver</a>
            </div>
        </div>
    </div>

    {{-- Sección de comentarios --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="fw-semibold mb-3 text-secondary">
                💬 Comentarios ({{ $post->comments->count() }})
            </h4>

            {{-- Lista de comentarios --}}
            @if($post->comments->count() > 0)
                @foreach ($post->comments as $comment)
                    <div class="border-bottom py-3">
                        <div class="d-flex align-items-center mb-2">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random&color=fff&rounded=true" 
                                 alt="Avatar" class="rounded-circle me-2" width="35" height="35">
                            <div>
                                <strong>{{ $comment->user->name }}</strong>
                                <small class="text-muted d-block">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <p class="mb-1 ps-5">{{ $comment->content }}</p>
                    </div>
                @endforeach
            @else
                <p class="text-muted">Aún no hay comentarios. ¡Sé el primero en comentar! 😃</p>
            @endif

            {{-- Formulario para agregar un nuevo comentario --}}
            @auth
                <div class="mt-4">
                    <form action="{{ route('comments.store', $post) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="content" class="form-label fw-semibold">Agrega un comentario:</label>
                            <textarea name="content" id="content" class="form-control shadow-sm" rows="3" placeholder="Escribe algo bonito..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send-fill me-1"></i> Enviar
                        </button>
                    </form>
                </div>
            @else
                <div class="alert alert-info mt-3" role="alert">
                    <i class="bi bi-person-circle"></i> Para comentar, <a href="{{ route('login') }}" class="alert-link">inicia sesión</a>.
                </div>
            @endauth
        </div>
    </div>

</div>
@endsection
