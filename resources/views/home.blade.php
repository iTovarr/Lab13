@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    
                </div>
               </div>

                <div style="
                 display: flex;
                 justify-content: center;
                  align-items: center;
                height: 200px; /* ajusta según el alto de tu recuadro */
                ">
                <a href="{{ route('posts.index') }}" 
                style="
                     display: inline-block;
                     background-color: #1a2a38ff;
                     color: white;
                     font-weight: 600;
                     text-decoration: none;
                     padding: 12px 32px;
                     border-radius: 30px;
                     box-shadow: 0 4px 10px rgba(0,0,0,0.2);
                     transition: all 0.3s ease;
                "
                 onmouseover="this.style.backgroundColor='#211d68ff'"
                 onmouseout="this.style.backgroundColor='#1a2a38ff'">
                  Ver Publicaciones
                </a>
                </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
