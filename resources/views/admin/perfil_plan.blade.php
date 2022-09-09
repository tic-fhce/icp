@extends('front.front_admin')

@section('label1')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-6">
                            <strong class="card-title mb-3">{{$titulo}}</strong> 
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('perfil_curso',$curso->id)}}" class="btn btn-sm btn-secondary btn-block"><i class="fa fa-mail-reply (alias)"></i> Regresar</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mx-auto d-block">                            
                            <h5 class="text-sm-center mt-2 mb-1">{{$curso->codigo}}</h5>
                        </div>
                        <hr>
                        <div class="mx-auto d-block"> 
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"> Estado :
                                    @if($plan->estado =='1')
                                        Activo
                                    @else
                                        Cerrado
                                    @endif
                                </li>
                                <li class="list-group-item">{{$curso->detalle}}</li>
                                <li class="list-group-item">Gestion : {{$curso->gestion}}</li>
                                <li class="list-group-item">Plan : {{$plan->nombre}}</li>
                                <li class="list-group-item">Tipo : {{$plan->tipo}}</li>
                                <li class="list-group-item">Detalle : {{$plan->detalle}}</li>
                                <li class="list-group-item">Costo : {{$plan->costo}}</li>
                                <li class="list-group-item">Moneda : {{$plan->moneda}}</li>
                                
                            </ul>
                        </div>

                    </div>
                    <div class="card-header">
                        <div class="col-md-4">
                            
                            @if($plan->estado =='1')
                                <a href="{{route('CerrarPlan',$plan->id)}}" class="btn btn-sm btn-danger">Cerrar Plan {{$curso->codigo}}</a>
                            @else
                                <a href="{{route('AbrirPlan',$plan->id)}}" class="btn btn-sm btn-success">Activar Plan {{$curso->codigo}}</a>
                            @endif

                        </div>

                        <div class="col-md-4">
                            @if($usuario->tipo<=1)
                            <a href="{{route('formulario_update_plan',$plan->id)}}" class="btn btn-sm btn-info"> Editar {{$curso->codigo}}</a>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <a href="{{route('perfil_curso',$curso->id)}}" class="btn btn-sm btn-secondary btn-block"><i class="fa fa-mail-reply (alias)"></i> Regresar</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6"><strong class="card-title">Datos del Plan de Cobros</strong></div>
                            <div class="col-md-6"><a href="{{route('perfil_curso',$curso->id)}}" class="btn btn-sm btn-secondary btn-block"><i class="fa fa-mail-reply (alias)"></i> Regresar</a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#cuota" role="tab" aria-controls="profile" aria-selected="false">Cuotas de Pago</a>
                            </li>
                            
                        </ul>
                        
                        <div class="tab-content pl-3 p-1" id="myTabContent">
                            
                            <!--Pago -->
                            <div class="tab-pane fade show active" id="cuota" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="col-lg-8">
                                                    <strong class="card-title">Lista de Cuotas Pertenecientes al Plan de Pagos {{$plan->nombre}}</strong>
                                                </div>                                                
                                                <div class="col-lg-4" align="right">
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#agregar">
                                                        Agregar Cuota
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @if(session('mensaje_error'))
                                                    <div class="alert alert-danger" role="alert">
                                                        {{session('mensaje_error')}}
                                                    </div>
                                                @endif
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Nombre</th>
                                                            <th scope="col">Monto</th>                                  
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i=0;?>
                                                        @foreach($cuota as $value)
                                                        <?php $i=$i+$value->monto?>
                                                        <tr>
                                                            <td scope="row">{{$value->id}}</td>
                                                            <td>{{$value->nombre}}</td>
                                                            <td>{{$value->monto}}</td>
                                                            <td>
                                                                @if($usuario->tipo<'2')
                                                                <a href="{{route('formulario_update_cuota',$value->id)}}" class="btn btn-sm btn-warning">Editar Cuota</a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="2">Total</td>
                                                            <td><h4>{{$i}} {{$plan->moneda}}</h4></td>
                                                            <td></td>
                                                        </tr>
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

<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Agregar Cuota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{route('AddCuota')}}" method="post">
                @csrf
                    <input type="hidden" name="id_curso" value="{{$curso->id}}">
                    <input type="hidden" name="id_plan" value="{{$plan->id}}">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nombre" required="true" placeholder="Nombre de la Cuota">
                    </div>
                    <div class="form-group">
                        <div class="alert alert-danger" role="alert">
                            Importante el precio o costo deberá de tener el siguiente esquema 3000.10 donde ".10" son los centavos, si el precio no cuenta con centavos solo colocar 3000 sin el tipo de moneda.
                        </div>
                        <input type="text" class="form-control" name="costo" required="true" placeholder="Costo total de la Cuota">
                    </div>
                    <div class="form-group">
                        <hr>
                    </div>
                    <button type="submit" class="btn btn-lg btn-info btn-block">Agregar Cuota</button> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

@endsection

