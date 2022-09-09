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
                        <strong class="card-title">Datos {{$pago->detalle}}</strong>
                    </div>
                    <div class="card-body">
                        <div class="col-md-6">
                            <form action="{{route('UpdatePago')}}" method="post">
                            @csrf
                                <input type="hidden" name="id_pago" value="{{$pago->id}}">
                                <input type="hidden" name="id_usuario" value="{{$perfil->id_usuario}}">
                                <input type="hidden" name="id_curso" value="{{$perfil->id_curso}}">

                                <div class="form-group">
                                    Monto : 
                                    <input type="text" class="form-control" name="monto" value="{{$pago->monto}}" required="true" maxlength="200">
                                </div>
                                <div class="form-group">
                                    Estado :
                                    <select name="estado" class="form-control" required="true">
                                        <option value="">Seleccionar</option>
                                        <option value="0">No Pagado</option>
                                        <option value="1">Pagado</option>
                                    </select>
                                </div>
                                                
                                <div class="form-group">
                                    Observaciones :
                                    <textarea name="obs" class="form-control">{{$pago->obs}}</textarea>
                                </div>
                                <div class="form-group">
                                    Fecha de Pago : {{$pago->fecha}} 
                                    <input type="date" name="fecha" class="form-control" required="true">
                                </div>

                                <div class="form-group">
                                <hr>
                                </div>
                                <button type="submit" class="btn btn-lg btn-info btn-block">Actualizar Cuota</button>
                                <?php $atras=array('id_usuario'=>$perfil->id_usuario,'id_curso'=>$perfil->id_curso); ?>

                                <a href="{{route('perfil',$atras)}}" class="btn btn-lg btn-info btn-block">Salir</a>
                                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
