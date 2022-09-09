@extends('front.front_admin')

@section('label1')

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        {{$titulo}}
                    </a>
                </div>
                <div class="login-form">

                    <form action="{{route('UpdatePass')}}" method="post">
                    @csrf
                    	@if(session('mensaje_error'))
                            <div class="alert alert-danger" role="alert">
                                {{session('mensaje_error')}}
                            </div>
                        @endif
                        @if(session('mensaje_success'))
                            <div class="alert alert-success" role="alert">
                                {{session('mensaje_success')}}
                            </div>
                        @endif
                        <div class="form-group">                            
                            <input type="text" name="pass" class="form-control" placeholder="Contraseña Actual">
                        </div>
                        <div class="form-group">                            
                            <input type="text" name="pass2" class="form-control" placeholder="Nueva Contraseña ">
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-success btn-lg btn-block">Actualizar Contraseña</button>
                        </div>

                        <div class="card-body">
                            <a href="{{route('a691jmmk69866ef77e7b8719892ac8d64efde',$usuario->pass)}}" class="btn btn-warning btn-lg btn-block">Salir</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection