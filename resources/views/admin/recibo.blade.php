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
                                    <h2 class="text-white display-6">{{$data->codigo}}</h2>
                                    <p class="text-light">{{$data->matricula}}</p>
                                    <p class="text-light">Gestion : {{$data->gestion}}</p>
                                </div>
                            </div>
                        </div>
                  
                        <div class="weather-category twt-category">
                            
                        </div>
                        <footer class="twt-footer">
                            <h4><strong class="card-title mb-3">{{$titulo}}</strong></h4>
                            {{$data->detalle}}
                            
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
                            <h3>Detalle de la Transaccion</h3>     
                        </div>
                        <div class="col-md-3">
                            @if($payment['estado']=='1')
                            <a href="{{route('Recibo',$payment['id_pago'])}}" class="btn btn-primary btn-block"><i class="fa fa-print"></i> Descargar Pdf</a>
                            @endif
                            
                        </div>
                        <div class="col-md-3">
                            <a href="{{route('estado')}}" class="btn btn-success btn-block">Salir</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($payment['estado']=='1')
                        <div class="alert alert-success" role="alert">
                            {{$payment['mensage']}}
                        </div>
                        @else
                        <div class="alert alert-danger" role="alert">
                            {{$payment['mensage']}}
                        </div>
                        @endif

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Order Number : <span>{{$payment['referencia']}}</span><br>
                                fecha : <span>{{$payment['fecha']}}</span>

                            </li>
                            <li class="list-group-item">
                                Detalle: <span>Pago por {{$payment['detalle']}}</span>
                            </li>
                            <li class="list-group-item">
                                Monto : <span>{{$payment['monto']}} {{$payment['moneda']}}</span>
                            </li>
                            <li class="list-group-item">
                                Reconciliation ID : <span>{{$payment['id_transaction']}}</span><br>
                                Transacción UUID : <span>{{$payment['uuid']}}</span>
                            </li>
                            <li class="list-group-item">
                                Nombre : <span>{{$datos->nombre}} {{$datos->apellido}}</span><br>
                                C.I. : <span>{{$datos->ci}}</span>
                            </li>
                            <li class="list-group-item">
                                 Codigo pago : <span>{{$payment['data87']}}</span>
                            </li>   
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
