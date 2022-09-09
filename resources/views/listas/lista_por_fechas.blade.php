@extends('front.front_admin')

@section('label1')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-6">
                            <strong class="card-title">{{$titulo}}</strong>
                        </div>
                        <div class="col-md-3">
                            <a href="{{route('reporte',$uri)}}" class="btn btn-primary btn-block"><i class="fa fa-print"></i> Descargar Extracto de pagos</a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{route('exportexcel',$uri)}}" class="btn btn-success btn-block"><i class="fa fa-print"></i> Descargar Extracto de Excel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID Pago</th>
                                    <th>C.I.</th>
                                    <th>Cliente</th>
                                    <th>Detalle</th>
                                    <th>Concepto</th>
                                    <th>Monto</th>
                                    <th>ID Transaccion</th>
                                    <th>Numero de Referencia</th>
                                    <th>UUID</th>
                                    <th>Fecha de Pago</th>
                                </tr>
                            </thead>
                            <tbody>
                               	<?php 
                                    $i=1;
                                    $total=0;
                                    $moneda="";
                                ?>
                               	@foreach($extracto as $value)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$value->id_pago}}</td> 
                                    <td>{{$value->ci}}</td>                                    
                                    <td>{{$value->nombre}} {{$value->apellido}}</td>
                                    <td><font size="2px">{{$value->detalle}}</font></td>
                                    <td>{{$value->concepto}} {{$value->matricula}}</td>
                                    <td>{{$value->monto}} {{$value->moneda}}</td>
                                    <td>{{$value->id_transaction}}</td>
                                    <td>{{$value->nreferencia}}</td>
                                    <td>{{$value->uuid}}</td>
                                    <td>{{$value->fecha}}</td>
                                </tr>
                                <?php 
                                    $i=$i+1;
                                    $total=$total+$value->monto;
                                    $moneda=$value->moneda;
                                ?>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th>#</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    
                                    <th colspan="3"><h3>Total</h3></th>
                                    
                                    <th colspan="3"><h3>{{$total}} {{$moneda}}</h3></th>
                            </tfoot>
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