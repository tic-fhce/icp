@extends('front.front_admin')

@section('label1')
@if($mensaje=='s')
	<div class="alert alert-success" role="alert">
    	Su usuario es : <strong>{{$usuario->usser}}</strong><br>
    	Su Contraseña es : <strong>{{$usuario->usser}}</strong><br>
    	Es recomendable que cambie su contraseña (Agá clic en su fotografía en la parte superior y selecciones Contraseña).
    </div>
    <div class="col-xl-8">
	    <div class="card">
	        <div class="card-body">
	            <div class="row">
	                <div class="col-sm-3">
	                    <h4 class="card-title mb-0">Politicas de Uso</h4>
	                    
	                </div>
	                <div class="col-sm-9">
	                	<ul>
							<li>Su número de tarjeta de crédito no se guarda en el sistema y ninguna otra información bancaria.</li>
							<li>No podrá realizar sus pagos mientras los coordinadores del Postgrado Verifiquen la legitimidad de sus documentos.</li>
							<li>Inscríbase al curso de su preferencia <a href="{{route('oferta',0)}}" class="btn btn-sm btn-success"> aquí </a> o en el menu Seleccionar Oferta Académica</li>
						</ul>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endif



@endsection