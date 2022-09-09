@extends('front.front_admin')

@section('label1')
<div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">{{$titulo}}</strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <form action="{{route('BuscarPorFechas')}}" method="post">
                                            @csrf
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    Desde : <input type="date" class="form-control" name="inicio" required="true">
                                                </div>    
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    Hasta : <input type="date" class="form-control" name="fin" required="true">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <select name="moneda" required="true" class="form-control">
                                                    <option value="">Seleccionar Moneda</option>
                                                    <option Value="BOB">BOB</option>
                                                    <option Value="USD">USD</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <hr>
                                            </div>
                                            <button type="submit" class="btn btn-lg btn-info btn-block">BUSCAR</button>

                                            <a href="{{route('a691jmmk69866ef77e7b8719892ac8d64efde',$usuario->pass)}}" class="btn btn-lg btn-info btn-block">Salir</a>
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