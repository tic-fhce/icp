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
                                <li class="list-group-item">Estado : 
                                    @if($curso->estado =='1') 
                                        Activo
                                    @else
                                        Caduco
                                    @endif
                                </li>
                                <li class="list-group-item">
                                    @if($usuario->tipo<'2')
                                        @if($curso->estado =='1') 
                                            <a href="{{route('CerrarCurso',$curso->id)}}" class="btn btn-sm btn-warning">Cerrar Curso</a>
                                        @else
                                            <a href="{{route('AbrirCurso',$curso->id)}}" class="btn btn-sm btn-success">Reanudar Curso</a>
                                        @endif
                                    @endif
                                </li>
                                
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
                            <div class="col-md-6"><a href="{{route('lista_curso')}}" class="btn btn-sm btn-secondary btn-block"><i class="fa fa-mail-reply (alias)"></i> Regresar</a></div>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#pago" role="tab" aria-controls="profile" aria-selected="false">Planes de Pago</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#modulos" role="tab" aria-controls="home" aria-selected="true">Modulos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#paralelo" role="tab" aria-controls="home" aria-selected="true">Paralelos</a>
                            </li>
                        </ul>
                        
                        <div class="tab-content pl-3 p-1" id="myTabContent">
                            <!--Planes -->
                            <div class="tab-pane fade show active" id="pago" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="col-lg-8">
                                                    <strong class="card-title">Lista de Planes Pertenecientes al Curso</strong>
                                                </div>                                                
                                                <div class="col-lg-4" align="right">
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#agregar">
                                                        Agregar Plan
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Plan</th>
                                                            <th scope="col">Tipo</th>
                                                            <th scope="col">Detalle</th>
                                                            <th scope="col">Moneda</th>
                                                            <th scope="col">Estado</th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($plan as $value)
                                                        <tr>
                                                            <th scope="row">{{$value->id}}</th>
                                                            <td>{{$value->nombre}}</td>
                                                            <td>{{$value->tipo}}</td>
                                                            <td>{{$value->detalle}}</td>
                                                            <td>{{$value->moneda}}</td>
                                                            <td>
                                                            @if($value->estado =='1')
                                                                <a href="{{route('CerrarPlan',$value->id)}}" class="btn btn-sm btn-danger">Activo</a>
                                                            @else
                                                                <a href="{{route('AbrirPlan',$value->id)}}" class="btn btn-sm btn-success">Caduco</a>
                                                            @endif
                                                            </td>
                                                            <td><a href="{{route('perfil_plan',$value->id)}}" class="btn btn-sm btn-info">Ver Detalles</a></td>
                                                        </tr>
                                                        @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Modulos -->

                            <div class="tab-pane fade " id="modulos" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="col-lg-8">
                                                    <strong class="card-title">Modulos</strong>
                                                </div>                                                
                                                <div class="col-lg-4" align="right">
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#agregarmodulo">
                                                        Agregar Modulos
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Sigla</th>
                                                            <th scope="col">Modulo</th>
                                                            <th scope="col">Docente</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($moduloR as $value)
                                                        <tr>
                                                            <th scope="row">{{$loop->iteration}}</th>
                                                            <td>{{$value->sigla}}</td>
                                                            <td>{{$value->curso}}</td>
                                                            <td>{{$value->ga}} {{$value->nombre}} {{$value->apellido}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!--Paralelos -->
                            <div class="tab-pane fade " id="paralelo" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="col-lg-8">
                                                    <strong class="card-title">Paralelos</strong>
                                                </div>                                                
                                                <div class="col-lg-4" align="right">
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#agregarparalelo">
                                                        Agregar Paralelo
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">sigla</th>
                                                            <th scope="col">Paralelo</th>
                                                            <th scope="col">Cupo Minimo / Actual</th>
                                                            <th scope="col">Cupo Maximo</th>
                                                            <th scope="col">Estado</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($paralelo as $value)
                                                        <tr>
                                                            <th scope="row">{{$loop->iteration}}</th>
                                                            <td>{{$value->sigla}}</td>
                                                            <td>{{$value->paralelo}}</td>
                                                            <td>{{$value->cupomin}}</td>
                                                            <td>{{$value->cupomax}}</td>
                                                            <td>{{$value->estado}}</td>
                                                            
                                                        </tr>
                                                        @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--Paralelos -->



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Agregar Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{route('AddPlan')}}" method="post">
                @csrf
                    <input type="hidden" name="id_curso" value="{{$curso->id}}">
                    <input type="hidden" name="codigo" value="{{$curso->codigo}}">
                    <div class="form-group">
                        <select name="nombre" required="true" class="form-control">
                            <option value="">Seleccionar Plan </option>
                            <option Value="A">A</option>
                            <option Value="B">B</option>
                            <option Value="C">C</option>
                            <option Value="D">D</option>
                            <option Value="E">E</option>
                            <option Value="F">F</option>
                            <option Value="G">G</option>
                            <option Value="H">H</option>
                            <option Value="I">I</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="tipo" required="true" class="form-control">
                            <option value="">Seleccionar Tipo </option>
                            <option Value="Nacional">Nacional</option>
                            <option Value="Extrangero">Extrangero</option>           
                        </select>
                    </div>
                    <div class="form-group">                                        
                        <textarea class="form-control" name="detalle" required="true">detalle</textarea>
                    </div>
                    <div class="form-group">                                        
                        <input type="text" class="form-control" name="costo" required="true" placeholder="Costo total del Plan">
                    </div>
                    <div class="form-group">
                        <hr>
                    </div>
                    <button type="submit" class="btn btn-lg btn-info btn-block">Agregar Plan</button> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="agregarmodulo" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Agregar Modulo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{route('AddModulo')}}" method="post">
                @csrf
                    <div class="form-group">                                        
                        <input type="text" class="form-control" name="sigla" required="true" placeholder="Sigla del Modulo">
                    </div>
                    <div class="form-group">                                        
                        <input type="text" class="form-control" name="nombre" required="true" placeholder="Titulo del Modulo">
                    </div>
                    <input type="hidden" name="id_curso" value="{{$curso->id}}">
                    <div class="form-group">
                        <hr>
                    </div>
                    <div class="form-group">
                        <select name="id_docente" required="true" class="form-control">
                            <option value="">Seleccionar Docente </option>
                            <option value="0">Docente por asignar </option>
                            @foreach($docente as $value)
                            <option Value="{{$value->id}}">{{$value->ga}} {{$value->nombre}} {{$value->apellido}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-lg btn-info btn-block">Agregar Modulo</button> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="agregarparalelo" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Agregar Paralelo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{route('AddParalelo')}}" method="post">
                @csrf
                    <input type="hidden" name="id_curso" value="{{$curso->id}}">
                    <input type="hidden" name="codigo" value="{{$curso->codigo}}">
                    <div class="form-group">
                        <select name="paralelo" required="true" class="form-control">
                            <option value="">Seleccionar Paralelo </option>
                            <option Value="A">A</option>
                            <option Value="B">B</option>
                            <option Value="C">C</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="sigla" required="true" class="form-control">
                            <option value="">Seleccionar El Modulo </option>
                            @foreach($modulo as $value)
                            <option Value="{{$value->sigla}}">{{$value->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">                                        
                        <input type="text" class="form-control" name="cupomin" required="true" placeholder="Cupo Minimo">
                    </div>
                    <div class="form-group">                                        
                        <input type="text" class="form-control" name="cupomax" required="true" placeholder="Cupo Maximo">
                    </div>
                    <div class="form-group">
                        <hr>
                    </div>
                    <button type="submit" class="btn btn-lg btn-info btn-block">Agregar Paralelo</button> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

@endsection

