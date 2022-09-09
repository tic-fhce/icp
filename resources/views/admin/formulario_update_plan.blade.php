@extends('front.front_admin')

@section('label1')

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">{{$titulo}}  -> {{$plan->nombre}} {{$plan->codigo}} moneda {{$plan->moneda}}</strong>
                    </div>
                    <div class="card-body">
                                <!-- Credit Card -->
                        <div id="pay-invoice">
                            <div class="card-body">
                                <form action="{{route('UpdatePlan')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" name="id_plan" value="{{$plan->id}}">

                                    <div class="form-group">                                        
                                        Detalle : 
                                        <textarea class="form-control" name="detalle" required="true">{{$plan->detalle}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        Costo en {{$plan->moneda}} : 
                                        <input type="text" class="form-control" name="costo" value="{{$plan->costo}}" required="true">
                                    </div>
                                   
                                    <button type="submit" class="btn btn-lg btn-info btn-block">Actualizar</button>
                                    <a href="{{route('perfil_plan',$plan->id)}}" class="btn btn-lg btn-info btn-block">Salir</a>
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