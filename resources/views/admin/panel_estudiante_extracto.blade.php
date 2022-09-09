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
                        <div class="col-md-6">
                            Detalle de Pagos
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('Extracto',$uri)}}" class="btn btn-primary btn-block"><i class="fa fa-print"></i> Descargar Extracto de pagos</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#pago" role="tab" aria-controls="profile" aria-selected="false">Plan de Pago</a>
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
                                                    <th scope="col">#</th>
                                                    <th scope="col">Detalle</th>
                                                    <th scope="col">Monto</th>
                                                    <th scope="col">Moneda</th>
                                                    <th scope="col">Estado</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $i=0;
                                                    $c=0;
                                                ?>
                                                @foreach($pagos as $value)
                                                <?php $i=$i+$value->monto?>
                                                <tr>
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->detalle}}</td>
                                                    <td>{{$value->monto}}</td>
                                                    <td>{{$value->moneda}}</td>
                                                    <td>
                                                        @if($value->estado=='0')
                                                            Pendiente
                                                        @else
                                                            <a href="{{route('reciboafter',$value->id)}}" class="btn btn-outline-success btn-sm">Pagado</a>
                                                            <?php $c=$c+$value->monto;?>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($value->estado=='0')
                                                        <a href="{{route('DetallePago',$value->id)}}" class="btn btn-outline-info btn-sm">Pagar</a>
                                                        @else                                                            
                                                            {{$value->fecha}}
                                                        @endif
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

@endsection

