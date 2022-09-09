@extends('front.front_admin')

@section('label1')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title mb-3">{{$titulo}}</strong>
                    </div>
                    <div class="card-body">
                        <div class="mx-auto d-block">                            
                            <h5 class="text-sm-center mt-2 mb-1">{{$curso->codigo}}</h5>
                        </div>
                        <hr>
                        <div class="mx-auto d-block"> 
                            @if(session('mensaje_success'))
                                <div class="alert alert-success" role="alert">
                                    {{session('mensaje_success')}}
                                </div>
                            @endif
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Tipo : {{$curso->tipo}}</li>
                                <li class="list-group-item">{{$curso->detalle}}</li>
                                <li class="list-group-item">Gestion : {{$curso->gestion}}</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6"><strong class="card-title">Datos del Curso {{$curso->codigo}}</strong></div>
                            <div class="col-md-6"><a href="{{route('lista_cursohistorial')}}" class="btn btn-sm btn-secondary btn-block"><i class="fa fa-mail-reply (alias)"></i> Regresar</a></div>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#modulo" role="tab" aria-controls="profile" aria-selected="false">Modulos</a>
                            </li>
                        </ul>
                        <div class="tab-content pl-3 p-1" id="myTabContent">
                            <!-- Modulos -->

                            <div class="tab-pane fade show active" id="modulos" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="col-lg-8">
                                                    <strong class="card-title">Modulos</strong>
                                                </div>                                                
                                                <!--<div class="col-lg-4" align="right">
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#agregarmodulo">
                                                        Agregar Modulos
                                                    </button>
                                                </div>-->
                                            </div>
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Sigla</th>
                                                            <th scope="col">Modulo</th>
                                                            <th scope="col">Docente</th>
                                                            <th scope="col">Notas</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($modulo as $value)
                                                        <?php $enlace = array('id_usuario' => $value->id_cursohistorial,'id_curso'=>$value->id); ?>
                                                        <tr>
                                                            <th scope="row">{{$loop->iteration}}</th>
                                                            <td>{{$value->sigla}}</td>
                                                            <td>{{$value->modulo}}</td>
                                                            <td>{{$value->tipodocente}} {{$value->nombres}} {{$value->apellidos}}</td>
                                                            <td><a href="{{url('notadocenteh',$enlace)}}" class="btn btn-outline-danger btn-sm">Acta de Notas</a></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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
    </div>
</div>
@endsection
