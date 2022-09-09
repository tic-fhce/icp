@extends('front.front_admin')

@section('label1')

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">{{$titulo}}  -> {{$cuota->nombre}} </strong>
                    </div>
                    <div class="card-body">
                                <!-- Credit Card -->
                        <div id="pay-invoice">
                            <div class="card-body">
                                <form action="{{route('UpdateCuota')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" name="id_cuota" value="{{$cuota->id}}">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nombre" value="{{$cuota->nombre}}" required="true">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="monto" value="{{$cuota->monto}}" required="true">
                                    </div>
                                   
                                    <button type="submit" class="btn btn-lg btn-info btn-block">Actualizar</button>
                                    <a href="{{route('perfil_plan',$cuota->id_plan)}}" class="btn btn-lg btn-info btn-block">Salir</a>
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