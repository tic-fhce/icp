@extends('front.front_admin')

@section('label1')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        {{$titulo}}
                        @if(session('mensaje'))
                            <div class="alert alert-danger" role="alert">
                                {{session('mensaje')}}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-md-3">Codigo : </div>
                            <div class="col-md-9">{{$pais->codigo}}</div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">Pais : </div>
                            <div class="col-md-9">{{$pais->pais}}</div>
                        </div>
                        <h2>Agregar Ciudades </h2>
                        <hr>

                        <form action="{{route('AddCiudad')}}" method="post">
                        @csrf
                            <input type="hidden" name="codigo" value="{{$pais->codigo}}">
                            <div class="row form-group">
                                <div class="col-md-3">Codigo : </div>
                                <div class="col-md-9"><input type="text" name="codigociudad" class="form-control" required="true" placeholder="Codigo de la Ciudad"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">Ciudad : </div>
                                <div class="col-md-9"><input type="text" name="ciudad" class="form-control" maxlength="100" required="true" placeholder="Nombre de la Ciudad"></div>
                            </div>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-6"><input type="submit" class="btn btn-success btn-block" name="submit" value="Adicionar Ciudad"/></div>
                                <div class="col-md-6"><a href="{{route('listaRegion')}}" class="btn btn-secondary btn-block">Cancelar</a></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">{{$titulo}}</div>
                            <div class="col-md-6"><a href="{{route('listaRegion')}}" class="btn btn-secondary btn-block"><i class="fa fa-undo"></i> Salir</a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Codigo</th>
                                    <th>Ciudad</th>                                    
                                </tr>                                                           
                            </thead>
                            <tbody>                                        
                                @foreach($ciudad as $value)                       
                                <tr>                                            
                                    <td>{{$value->id}}</td>                                    
                                    <td>{{$value->codigociudad}}</td>
                                    <td>{{$value->ciudad}}</td>                                    
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

@endsection