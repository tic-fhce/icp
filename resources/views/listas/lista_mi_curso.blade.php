@extends('front.front_admin')

@section('label1')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">{{$titulo}}</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Codigo</th>
                                    <th>Detalle</th>                                    
                                    <th>Matricula</th>
                                    <th>Habilitado</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               	<?php $i=1;?>
                               	@foreach($cursos as $value)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$value->codigo}}</td>
                                    <td>{{$value->detalle}}</td>
                                    <td>{{$value->matricula}}</td>
                                    <td>{{$value->habilitado}}</td>
                                    <td>
                                        @if($value->estado_estudiante=='1')
                                            Curso Actual
                                        @endif
                                        @if($value->estado_estudiante=='2')
                                            Curso Terminado
                                        @endif
                                        @if($value->estado_estudiante=='0')
                                            Curso Pendiente
                                        @endif
                                    </td> 
                                    <td>
                                        @if($value->estado_estudiante=='1')
                                             <a href="{{route('estadocurso',$value->id_curso)}}" class="btn btn-outline-warning btn-sm">Ver Curso</a>                                        @endif
                                        @if($value->estado_estudiante=='2')
                                            <?php $perfil = array('id_usuario' => $value->id_usuario,'id_curso'=>$value->id_curso); ?>
                                            <a href="{{route('estracto',$value->id_curso)}}" class="btn btn-outline-success btn-sm">Ver Curso</a>
                                        @endif
                                        @if($value->estado_estudiante=='0')
                                            <a href="{{route('micurso')}}" class="btn btn-outline-warning btn-sm">Ver Curso</a>
                                        @endif
                                    </td>
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