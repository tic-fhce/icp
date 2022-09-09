@extends('front.front_admin')

@section('label1')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-4">
                <section class="card">
                    <div class="twt-feed bg-flat-color-3">
                        <div class="corner-ribon black-ribon">
                            <i class="fa fa-tasks"></i>
                        </div>
                        <div class="fa fa-tasks wtt-mark"></div>

                            <div class="media">
                                <a href="#">
                                    
                                </a>
                                <div class="media-body">                                    
                                    <h2 class="text-white display-6">{{$perfil->nombre}}</h2>
                                    <p class="text-light">{{$perfil->ci}}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">C.I. : {{$perfil->ci}}</li>
                                <li class="list-group-item">Nombre(s) : {{$perfil->nombre}}</li>
                                <li class="list-group-item">Apellidos(s) : {{$perfil->apellido}}</li>
                                <li class="list-group-item">Correo : {{$perfil->correo}}</li>
                                <li class="list-group-item">Celular : {{$perfil->celular}}</li>
                            </ul>
                        </div>

                        <footer class="twt-footer">
                            <h4></h4>
                        </footer>
                </section>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Datos Usuario</strong>
                        @if(session('mensaje_success'))
                            <div class="alert alert-success" role="alert">
                                {{session('mensaje_success')}}
                            </div>
                        @endif
                        @if(session('mensaje_danger'))
                            <div class="alert alert-warning" role="alert">
                                {{session('mensaje_danger')}}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#pass" role="tab" aria-controls="contact" aria-selected="false">Contraseña</a>
                            </li>
                        </ul>
                        
                        <div class="tab-content pl-3 p-1" id="myTabContent">
                            <!--Datos -->
                            <div class="tab-pane fade " id="datos" role="tabpanel" aria-labelledby="home-tab">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"></li>
                                    <li class="list-group-item"></li>
                                    <li class="list-group-item"></li>                                    
                                </ul>
                            </div>
                            
                            <!--Contraseña de Usuario -->

                            <div class="tab-pane fade show active" id="pass" role="tabpanel" aria-labelledby="profile-tab">
                                <h3>Restableser Contraseña de Usuario</h3>
                                <br>
                                <a href="{{route('restPass',$perfil->id_usuario)}}" class="btn btn-danger btn-sm">Restableser Contraseña</a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
