@extends('front.front_admin')

@section('label1')
<div class="content mt-3">
    <div class="animated fadeIn">
	 @if(Session::has('info'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('info')}}
        </div>
        @endif
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
                                    <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{asset('storage/'.$perfil->foto)}}">
                                </a>
                                <div class="media-body">                                    
                                    <h2 class="text-white display-6">{{$perfil->nombre}}</h2>
                                    <p class="text-light">{{$perfil->ci}}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Titulo : {{$perfil->titulo}}</li>
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
                        <strong class="card-title">Curso Matriculado: {{$perfil->detalle}}</strong>
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
                            @php
                                $sw=1;  
                            @endphp
                            @foreach ($modulo as $value)
                                @if ($sw===1)
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#{{$value->sigla}}" role="tab" aria-controls="home" aria-selected="true">{{$value->sigla}}</a>
                                </li> 
                                @php
                                    $sw=0;
                                @endphp
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#{{$value->sigla}}" role="tab" aria-controls="home" aria-selected="true">{{$value->sigla}}</a>
                                </li>  
                                @endif
                            @endforeach
                        </ul>
                        
                        <div class="tab-content pl-3 p-1" id="myTabContent">
                            <!--Datos -->
                            @php
                                $sw1=1;
                            @endphp
                            @foreach ($modulo as $value)
                                @if ($sw1===1)
                                <div class="tab-pane fade show active" id="{{$value->sigla}}" role="tabpanel" aria-labelledby="home-tab">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">{{$perfil->detalle}}</li>
                                        <li class="list-group-item">Tipo : {{$perfil->matricula}}</li>
                                        <li class="list-group-item">Codigo del Curso : {{$perfil->codigo}}</li>
                                        <li class="list-group-item">Modulo : {{$value->nombre}}</li>
                                        <li class="list-group-item">
                                            <form action="{{route('registraNota')}}" method="post">
                                            @csrf
                                                <input type="hidden" name="id_estudiante" value="{{$perfil->id_persona}}">
                                                <input type="hidden" name="id_curso" value="{{$perfil->id_curso}}">
                                                <input type="hidden" name="sigla" value="{{$value->sigla}}">
                                                <div class="row form-group">
                                                    <div class="col-sm-1 col-form-label">Nota :</div>
                                                    <div class="col-sm-11"><input type="text" name="notaFinal" class="form-control" maxlength="100" required="true" placeholder="Nota del Estudiante"></div>
                                                </div>
                                                <hr>
                                                <div class="row form-group">
                                                    <div class="col-md-3"><button type="submit" class="btn btn-success btn-block btn-sm m-1"><i class="fa fa-pencil-square-o"></i> Registrar Nota</button></div>
                                                    <!--<div class="col-md-4"><input type="submit" class="btn btn-success btn-block" name="submit" value="Adicionar Ciudad"/></div>-->
                                                    <div class="col-md-3"><a href="{{asset('lista_estudiantem/'.$perfil->id_curso.'/'.$value->sigla)}}" class="btn btn-secondary btn-block btn-sm m-1"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a></div>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                @php
                                    $sw1=0;
                                @endphp
                                @else
                                <div class="tab-pane fade" id="{{$value->sigla}}" role="tabpanel" aria-labelledby="home-tab">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">{{$perfil->detalle}}</li>
                                        <li class="list-group-item">Tipo : {{$perfil->matricula}}</li>
                                        <li class="list-group-item">Codigo del Curso : {{$perfil->codigo}}</li>
                                        <li class="list-group-item">Modulo : {{$value->nombre}}</li>
                                        <li class="list-group-item">
                                            <form action="{{route('registraNota')}}" method="post">
                                            @csrf
                                                <input type="hidden" name="id_estudiante" value="{{$perfil->id_persona}}">
                                                <input type="hidden" name="id_curso" value="{{$perfil->id_curso}}">
                                                <input type="hidden" name="sigla" value="{{$value->sigla}}">
                                                <div class="row form-group">
                                                    <div class="col-sm-1 col-form-label">Nota :</div>
                                                    <div class="col-sm-11"><input type="text" name="notaFinal" class="form-control" maxlength="100" required="true" placeholder="Nota del Estudiante"></div>
                                                </div>
                                                <hr>
                                                <div class="row form-group">
                                                    <div class="col-md-3"><button type="submit" class="btn btn-success btn-block btn-sm m-1"><i class="fa fa-pencil-square-o"></i> Registrar Nota</button></div>
                                                    <!--<div class="col-md-4"><input type="submit" class="btn btn-success btn-block" name="submit" value="Adicionar Ciudad"/></div>-->
                                                    <div class="col-md-3"><a href="{{asset('lista_estudiantem/'.$perfil->id_curso.'/'.$value->sigla)}}" class="btn btn-secondary btn-block btn-sm m-1"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a></div>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
