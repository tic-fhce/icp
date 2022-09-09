@extends('front.front')

@section('label1')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{$titulo}}
                        @if(session('mensaje_error'))
                            <div class="alert alert-danger" role="alert">
                                {{session('mensaje_error')}}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">

                        <form action="{{route('Reporte_Cliente')}}" method="post">
                        @csrf
                            <div class="row form-group">
                                <div class="col-md-2">Del : </div>
                                <div class="col-md-4"><input type="date" name="inicio" class="form-control" required="true"></div>
                                <div class="col-md-2">Al  : </div>
                                <div class="col-md-4"><input type="date" name="fin" class="form-control" required="true"></div>
                            </div>
                            
                            <div class="row form-group">
                                <div class="col-md-3">Moneda :</div>
                                <div class="col-md-9">
                                    <select name="moneda" required="true" class="form-control">
                                        <option value="">Seleccionar Moneda</option>
                                        <option value="BOB">BOB</option>
                                        <option value="USD">USD</option>
                                    </select>
                                </div>
                            </div>
                            
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-6"><input type="submit" class="btn btn-success btn-block" name="submit" value="Buscar"/></div>
                                <div class="col-md-6"><a href="#" class="btn btn-secondary btn-block">Cancelar</a></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6"></div>
        </div>
    </div>
</div>

@endsection