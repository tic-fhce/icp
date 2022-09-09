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
                        <strong class="card-title">Datos del Curso Matriculado {{$perfil->detalle}}</strong>
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
                                <a class="nav-link active" data-toggle="tab" href="#datos" role="tab" aria-controls="home" aria-selected="true">Datos de Postulacion</a>
                            </li>
                            @if($usuario->tipo<'2')
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pago" role="tab" aria-controls="profile" aria-selected="false">Datos de Pago</a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#pagodetalle" role="tab" aria-controls="contact" aria-selected="false">Plan Pagos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#pass" role="tab" aria-controls="contact" aria-selected="false">Contraseña</a>
                            </li>
                        </ul>
                        
                        <div class="tab-content pl-3 p-1" id="myTabContent">
                            <!--Datos -->
                            <div class="tab-pane fade show active" id="datos" role="tabpanel" aria-labelledby="home-tab">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{$perfil->detalle}}</li>
                                    <li class="list-group-item">Tipo : {{$perfil->matricula}}</li>
                                    <li class="list-group-item">Codigo : {{$perfil->codigo}}</li>


                                    <li class="list-group-item">Documentos del Estudiante <a href="{{asset('storage/'.$perfil->documento)}}" class="btn btn-success btn-sm"><i class="fa fa-cloud-download"></i> Descargar</a></li>
                                    <li class="list-group-item">Habilitado : {{$perfil->habilitado}} -> 
                                        @if ($perfil->habilitado=='NO')
                                            <a href="{{route('HabilitarPago',$perfil->id_estudiante)}}" class="btn btn-success btn-sm">Habilitar</a>
                                        @else
                                            <a href="{{route('CancelarPago',$perfil->id_estudiante)}}" class="btn btn-danger btn-sm">Dar de Baja</a>
                                        @endif

                                    </li>
                                </ul>
                            </div>
                            <!--Datos de Pago -->

                            <div class="tab-pane fade" id="pago" role="tabpanel" aria-labelledby="profile-tab">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{$perfil->correo}}</a></li>
                                    <li class="list-group-item">{{$perfil->celular}}</li>
                                    <li class="list-group-item">{{$perfil->direccion}}</li>
                                    <li class="list-group-item">{{$perfil->pais}}</li>
                                    <li class="list-group-item">{{$perfil->ciudad}}</li>
                                    
                                </ul>
                            </div>
                            <!--Plan de pagos -->
                            
                            <!--Contraseña de Usuario -->

                            <div class="tab-pane fade" id="pass" role="tabpanel" aria-labelledby="profile-tab">
                                <h3>Restableser Contraseña de Usuario</h3>
                                <br>
                                La contraseña se restablese al C.I. del usuario
                                <br>
                                <a href="{{route('restPass',$perfil->id_usuario)}}" class="btn btn-danger btn-sm">Restableser Contraseña</a>
                            </div>
                            <!--Contraseña de Usuario -->

                            <div class="tab-pane fade" id="pagodetalle" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="col-lg-8">
                                                    <strong class="card-title"></strong>
                                                </div>                                                
                                                <div class="col-lg-4" align="right">
                                                    @if ($perfil->habilitado=='SI' and $perfil->estado_estudiante=='1')
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#agregarcuota">
                                                        Agregar Cuota
                                                    </button>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Detalle</th>
                                                            <th scope="col">Monto</th>
                                                            <th scope="col">Moneda</th>
                                                            <th scope="col" colspan="2">Estado</th>                                
                                                            <th scope="col">Obs</th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            $i=0;
                                                            $c=0;
                                                        ?>
                                                        @foreach($pago as $value)
                                                        <?php $i=$i+$value->monto?>
                                                        <tr>
                                                            <td>{{$value->id}}</td>
                                                            <td>{{$value->detalle}}</td>
                                                            <td>{{$value->monto}}</td>
                                                            <td>{{$value->moneda}}</td>
                                                            <td>
                                                                @if($value->estado=='0')
                                                                    <?php $uri= array('id_usuario' =>$perfil->id_usuario,'id_pago'=>$value->id ); ?>
                                                                    @if($usuario->tipo<=1)
                                                                    <a href="{{route('FormularioUpdatePago',$uri)}}"  class="btn btn-outline-info btn-sm">Pendiente</a>
                                                                    @else
                                                                        <a href="#"  class="btn btn-outline-info btn-sm">Pendiente</a>
                                                                    @endif
                                                                @else
                                                                    <?php $uri= array('id_usuario' =>$perfil->id_usuario,'id_pago'=>$value->id ); ?>
                                                                    <a href="#"  class="btn btn-outline-success btn-sm">Pagado</a>
                                                                    <?php $c=$c+$value->monto;?>
                                                                @endif
                                                            </td>
                                                            <td>{{$value->fecha}}</td>
                                                            <td>{{$value->obs}}</td>
                                                            <td>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <label class="alert alert-primary" role="alert">Total a pagar : {{$i}}</label>
                                                <label class="alert alert-success" role="alert">Total pagado : {{$c}}</label>
                                                <label class="alert alert-danger" role="alert">Deuda : {{$i-$c}}</label>
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

<div class="modal fade" id="agregarcuota" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Agregar Nueva Cuota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{route('AddPago')}}" method="post">
                @csrf
                    <input type="hidden" name="id_usuario" value="{{$perfil->id_usuario}}">
                    <input type="hidden" name="id_persona" value="{{$perfil->id_persona}}">
                    <input type="hidden" name="id_plan" value="{{$perfil->id_plan}}">
                    <input type="hidden" name="id_curso" value="{{$perfil->id_curso}}">
                    <input type="hidden" name="id_estudiante" value="{{$perfil->id_estudiante}}">
                    <input type="hidden" name="id_datopago" value="{{$perfil->id_datospago}}">
                    <div class="form-group">
                        <input type="text" class="form-control" name="detalle" required="true" placeholder="Nombre de la Cuota">
                    </div>
                    <div class="form-group">
                        <div class="alert alert-danger" role="alert">
                            Importante el precio o costo deberá de tener el siguiente esquema 3000.10 donde ".10" son los centavos, si el precio no cuenta con centavos solo colocar 3000 sin el tipo de moneda.
                        </div>
                        <input type="text" class="form-control" name="monto" required="true" placeholder="Monto">
                    </div>
                    <div class="form-group">
                        Observaciones :
                        <textarea name="obs" required="true" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <hr>
                    </div>

                    <button type="submit" class="btn btn-lg btn-info btn-block">Agregar Nueva Cuota</button> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection
