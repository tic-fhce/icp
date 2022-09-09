@extends('front.front_admin')

@section('label1')
<div class="content mt-3">
    <div class="animated fadeIn">
@if(Session::has('info'))
            <div class="alert alert-success" role="alert">
                {{Session::get('info')}}
            </div>
            @endif
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">                        
                        <div class="row">
                            <div class="col-md-6"><strong class="card-title">{{$titulo}}</strong></div>
                            <div class="col-md-6"><a href="{{route('listaModulo')}}" class="btn btn-sm btn-secondary btn-block"><i class="fa fa-mail-reply (alias)"></i> Regresar</a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Modulo</th>
                                    <th>Estudiante</th>
                                    <th>Correo</th>
                                    <th>Estado</th>
                                    <th>Habilitado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               	<?php $i=1;?>
                               	@foreach($lista as $value)
                                <?php $perfil = array('id_usuario' => $value->id_usuario,'id_curso'=>$value->id_curso,'sigla'=>$value->sigla); ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$value->sigla}}</td>
                                    <td style="text-transform: uppercase;">{{$value->apellido}} {{$value->nombre}}</td>
                                    <td>{{$value->correo}}</td>
                                    <td>
                                        @if($value->estado=='1')
                                            Curso Actual
                                        @endif
                                        @if($value->estado=='2')
                                            Curso Terminado
                                        @endif
                                        @if($value->estado=='0')
                                            Curso Pendiente
                                        @endif
                                    </td>
                                    <td>{{$value->habilitado}}</td>
                                    <td><a href="{{route('addnota',$perfil)}}" class="btn btn-outline-danger btn-sm">Registrar Nota</a></td>
                                </tr>
                                <?php $i=$i+1;?>
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

@section('scripts')
	<script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('vendors/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/js/init-scripts/data-table/datatables-init.js')}}"></script>
@endsection