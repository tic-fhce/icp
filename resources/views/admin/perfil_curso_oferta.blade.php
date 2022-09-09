@extends('front.front_admin')

@section('label1')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-4">
                <section class="card">
                    <div class="twt-feed bg-flat-color-3">
                        <div class="corner-ribon black-ribon">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <div class="fa fa-user-plus wtt-mark"></div>

                            <div class="media">
                                <a href="#">
                                    <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{asset('storage/'.$datos->foto)}}">
                                </a>
                                <div class="media-body">                                    
                                    <h2 class="text-white display-6">{{$curso->codigo}}</h2>
                                    <p class="text-light">{{$curso->tipo}}</p>
                                    <p class="text-light">Gestion : {{$curso->gestion}}</p>
                                </div>
                            </div>
                        </div>
                  
                        <div class="weather-category twt-category">
                            
                        </div>
                        <footer class="twt-footer">
                            <h4><strong class="card-title mb-3">{{$titulo}}</strong></h4>
                            {{$curso->detalle}}
                        </footer>
                        <div class="alert alert-success" role="alert">Recuerda no podrás pagar la colegiatura hasta que los Coordinadores Aprueben tus Documentos.</div>
                        <div class="card-footer">
                            <strong class="card-title mb-3">Datos</strong><br>
                            Nombre(s) : {{$datos->nombre}}<br>
                            Apellido(s) : {{$datos->apellido}}<br>
                            Correo : {{$datos->correo}}<br>
                            Tel-Cel : {{$datos->celular}}<br>
                        </div>
                </section>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Datos del Curso {{$curso->codigo}}</strong>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#pago" role="tab" aria-controls="profile" aria-selected="false">Planes de Pago</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#paralelo" role="tab" aria-controls="home" aria-selected="true">Paralelos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#postular" role="tab" aria-controls="home" aria-selected="true">Postular</a>
                            </li>
                        </ul>
                        
                        <div class="tab-content pl-3 p-1" id="myTabContent">
                            <!--Planes -->
                            <div class="tab-pane fade show active" id="pago" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Plan</th>
                                                    <th scope="col">Tipo</th>
                                                    <th scope="col">Detalle</th>
                                                    <th scope="col">Moneda</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($plan as $value)
                                                <tr>
                                                    <td>{{$value->nombre}}</td>
                                                    <td>{{$value->tipo}}</td>
                                                    <td>{{$value->detalle}}</td>
                                                    <td>{{$value->moneda}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!--Paralelos -->
                            <div class="tab-pane fade " id="paralelo" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-lg-12">

                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Paralelo</th>
                                                            <th scope="col">Cupo Minimo / Actual</th>
                                                            <th scope="col">Cupo Maximo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($paralelo as $value)
                                                        <tr>
                                                            <td>{{$value->paralelo}}</td>
                                                            <td>{{$value->cupomin}}</td>
                                                            <td>{{$value->cupomax}}</td>
                                                        </tr>
                                                        @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                    </div>

                                </div>
                            </div>
                            <!--Paralelos -->

                            <!--Postular -->
                            <div class="tab-pane fade " id="postular" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="respuesta"></div>
                                        <form action="{{route('AddEstudianteCurso')}}" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_usuario" value="{{$usuario->id}}">
                                            <input type="hidden" name="id_persona" value="{{$datos->id}}">
                                            <input type="hidden" name="id_curso" value="{{$curso->id}}">
                                            <div class="form-group">
                                                <br><h4>El documento en formato ZIP o RAR deberá de contener lo siguiente:</h4><br>
                                                <ul>
                                                    <li>Documento de identidad escaneado.</li>
                                                    <li>Título (s) Académico (s)  escaneado(s).</li>
                                                    <li>Carta dirigida a la Decana de la Facultad de Humanidades y Ciencias de la Educación (firmada) escaneada.</li>
                                                    <li>Carta de compromiso (firmada).</li>
                                                    <li>C.V. sin documentar (máximo dos hojas).</li> 
                                                </ul>
                                                <hr>
                                            </div>                                            
                                            @csrf                                            
                                            <div class="form-group">
                                                <select name="titulo" required="true" class="form-control">
                                                    <option value="">Seleccione el Título Académico que presentará</option>
                                                    <option value="Técnico_Superior">Técnico Superior</option>
                                                    <option value="Certificado_de_Egreso">Certificado de Egreso</option>
                                                    <option value="Licenciatura">Licenciatura</option>
                                                    <option value="Maestria">Maestría</option>
                                                    <option value="Doctorado">Doctorado</option>

                                                </select>
                                            </div>

                                            
                                            <div class="form-group">
                                                <hr>
                                            </div>

                                            <div class="form-group">
                                                <label>Documentos </label>
                                                <input type="file" name="folder" class="form-control" required="true" accept=".rar, .zip, .7zip">
                                            </div>
                                            <button type="submit" id="subir" class="btn btn-primary btn-flat m-b-30 m-t-30">Postular</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <!--Postular -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
        $(function(){
            $('#subir').on('click',mensaje);

        });
        function mensaje(){
            $('#respuesta').html("Subiendo los Archivos Esto Podria tardar un Minuto");
            alert('mecojo a la cristi');
        }
    </script>
@endsection

