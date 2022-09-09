@extends('front.front_admin')

@section('label1')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-4">
                <section class="card">
                    <div class="twt-feed bg-flat-color-3">
                        <div class="corner-ribon black-ribon">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <div class="fa fa-user-plus wtt-mark"></div>

                            <div class="media">
                                <a href="#">
                                    <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{asset('storage/'.$datos->foto)}}">
                                </a>
                                <div class="media-body">                                    
                                    <h2 class="text-white display-6">{{$curso->codigo}}</h2>
                                    <p class="text-light">{{$curso->matricula}}</p>
                                    <p class="text-light">Gestion : {{$curso->gestion}}</p>
                                </div>
                            </div>
                        </div>
                  
                        <div class="weather-category twt-category">
                            
                        </div>
                        <footer class="twt-footer">
                            <h4><strong class="card-title mb-3">{{$titulo}}</strong></h4>
                            {{$curso->detalle}}
                        </footer>
                        @if($curso->habilitado=='NO')
                        <div class="alert alert-success" role="alert">Recuerda no podrás pagar la colegiatura hasta que los Coordinadores Aprueben tus Documentos.</div> 
                        @endif
                        <div class="card-footer">
                            <strong class="card-title mb-3">Datos</strong><br>
                            Nombre(s) : {{$datos->nombre}}<br>
                            Apellido(s) : {{$datos->apellido}}<br>
                            Correo : {{$datos->correo}}<br>
                            Tel-Cel : {{$datos->celular}}<br>
                        </div>
                </section>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if($curso->habilitado=='SI')
                            <div class="alert alert-success" role="alert">
                                HABILITADO PARA EL PAGO  "{{$curso->matricula}}"
                            </div>
                        @else
                            <div class="alert alert-danger" role="alert">
                                NO ESTÁ HABILITADO PARA EL PAGO 
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#pago" role="tab" aria-controls="profile" aria-selected="false">Planes de Pago</a>
                            </li>
                        </ul>
                        
                        <div class="tab-content pl-3 p-1" id="myTabContent">
                            <!--Planes -->
                            <div class="tab-pane fade show active" id="pago" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Plan</th>
                                                    <th scope="col">Tipo</th>
                                                    <th scope="col">Detalle</th>
                                                    <th scope="col">Moneda</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($plan as $value)
                                                <tr>
                                                    <td>{{$value->nombre}}</td>
                                                    <td>{{$value->tipo}}</td>
                                                    <td>{{$value->detalle}}</td>
                                                    <td>{{$value->moneda}}</td>
                                                    <td>
                                                        @if($curso->habilitado=='SI')
                                                        <?php $perfil=array('id_plan'=>$value->id,'id_curso'=>$curso->id_curso); ?>
                                                        <a href="{{route('CrearPlan',$perfil)}}" class="btn btn-outline-info btn-sm">Unirse al Plan</a>
                                                        @else
                                                            No esta Habilitado
                                                        @endif
                                                    </td>
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

@endsection

