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
                                <form action="{{route('AddCurso')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="codigo" placeholder="Codigo del Curso" required="true">
                                    </div>
                                    <div class="form-group">
                                        <select name="tipo" required="true" class="form-control">
                                            <option value="">Seleccionar Tipo de Curso</option>
                                            @foreach($matricula as $value)
                                                <option Value="{{$value->id}}">{{$value->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">                                        
                                        <textarea class="form-control" name="detalle" required="true"></textarea>
                                    </div>
                                    <div class="form-group">                                        
                                        <input type="date" class="form-control" name="gestion" required="true">
                                    </div>

                                    <div class="form-group">
                                        <hr>
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-info btn-block">Crear Curso</button>

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