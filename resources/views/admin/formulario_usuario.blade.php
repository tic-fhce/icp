@extends('front.front_admin')

@section('label1')
<div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">{{$titulo}}</strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        @if(session('mensaje_error'))
                                            <div class="alert alert-danger" role="alert">
                                                {{session('mensaje_error')}}
                                            </div>
                                        @endif
                                        <form action="{{route('AddUsuario')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ci" placeholder="Cèdula de Identidad" required="true" maxlength="20">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="nombre" placeholder="Nombre (s)" required="true">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="apellido" placeholder="Apellido (s)" required="true">
                                            </div>
                                            
                                            <div class="form-group">
                                                <input type="email" name="correo" class="form-control" placeholder="Correo" required="true" maxlength="50">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="celular" class="form-control" placeholder="Celular" required="true" maxlength="50">
                                            </div>

                                            <div class="form-group">
                                                <select name="tipo" required="true" class="form-control">
                                                    <option value="">Seleccionar Tipo</option>
                                                    <option Value="1">Admin</option>
                                                    <option Value="2">Gestor</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <hr>
                                            </div>
                                            <button type="submit" class="btn btn-lg btn-info btn-block">Crear Usuario</button>

                                            <a href="{{route('a691jmmk69866ef77e7b8719892ac8d64efde',$usuario->pass)}}" class="btn btn-lg btn-info btn-block">Salir</a>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>

@endsection