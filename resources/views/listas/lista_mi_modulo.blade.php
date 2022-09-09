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
                                    <th>Curso</th>                                    
                                    <th>Modulo</th>
                                    <th>Sigla</th>
                                    <th>Gestion</th>                                   
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $i=1;?>
                              
                              @foreach($lista as $value)
                              <?php $enlace = array('id_curso' => $value->id_curso,'id_sigla'=>$value->sigla); ?>
                                <tr>
                                    <td>{{$i}}</td>                                    
                                    <td>{{$value->detalle}}</td>
                                    <td>{{$value->nombre}}</td>
                                    <td>{{$value->sigla}}</td>
                                    <td>{{$value->gestion}}</td>
                                    <td><a href="{{url('lista_estudiantem',$enlace)}}" class="btn btn-outline-success btn-sm">Ver Estudiantes</a></td>
                                    <td><a href="{{url('notadocente',$enlace)}}" class="btn btn-outline-danger btn-sm">Acta de Notas</a></td>
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