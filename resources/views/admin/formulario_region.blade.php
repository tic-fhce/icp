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

                        <form action="{{route('AddPais')}}" method="post">
                        @csrf
                            <div class="row form-group">
                                <div class="col-md-3">Codigo : </div>
                                <div class="col-md-9"><input type="text" name="codigo" class="form-control" required="true" placeholder="Codigo del Pais"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">Pais : </div>
                                <div class="col-md-9"><input type="text" name="pais" class="form-control" maxlength="100" required="true" placeholder="Nombre del Pais"></div>
                            </div>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-6"><input type="submit" class="btn btn-success btn-block" name="submit" value="Crear Nuevo Pais"/></div>
                                <div class="col-md-6"><a href="{{route('a691jmmk69866ef77e7b8719892ac8d64efde',$usuario->pass)}}" class="btn btn-secondary btn-block">Cancelar</a></div>
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