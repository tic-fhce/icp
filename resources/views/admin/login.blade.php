@extends('front.front')

@section('label1')

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
            	<div class="login-logo">
                    <a href="index.html">
                    	<img class="align-content" src="{{asset('images/iconopg.png')}}" width="120px" height="120px">
                    </a>
                </div>
                <div class="login-form">
                    <form action="{{route('login')}}" method="post">
                    @csrf
                    	@if(session('mensaje_error'))
                            <div class="alert alert-danger" role="alert">
                                {{session('mensaje_error')}}
                            </div>
                        @endif
                        <div class="form-group">
                            <label>Usuario</label>
                            <input type="text" name="usser" class="form-control" placeholder="Usuario">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Ingresar</button>

                        <div class="social-login-content">
                            <div class="social-button">
                                <a href="{{route('formulario_registro')}}" class="btn social facebook btn-flat btn-addon mb-3">Registrate</a>
                            </div>
                        </div>
                        <div class="container">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md p-1">
                                    <button type="button" class="btn btn-info btn-sm " data-toggle="modal" data-target="#staticBackdrop">
                                    <i class="fa fa-play-circle" aria-hidden="true"></i> Como registrarme
                                    </button>
                                    </div>
                                    <div class="col-md p-1">
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#staticBackdrop1">
                                    <i class="fa fa-play-circle" aria-hidden="true"></i> Como pagar con tarjeta
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Como Registrarme</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container text-center">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/Uy10_eGp0Ss" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>

                        <!-- Modal 1 -->
                        <div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Como pagar con tarjeta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container text-center">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/g9LCwlXiR-E" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection