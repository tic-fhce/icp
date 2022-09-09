@extends('front.front')

@section('label1')
<div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="{{asset('images/iconopg.png')}}" width="120px" height="120px">
                    </a>
                </div>
                <div class="login-form">
                    @if(session('mensaje_error'))
                        <div class="alert alert-danger" role="alert">
                            {{session('mensaje_error')}}
                        </div>
                    @endif
                    <form action="{{route('AddEstudiante')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="ci" placeholder="Cèdula de Identidad" required="true" maxlength="20">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre (s)" required="true">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="apellido" placeholder="Apellido (s)" required="true">
                        </div>
                        
                        <div class="form-group">
                            <input type="email" name="correo" class="form-control" placeholder="Correo" required="true" maxlength="50">
                        </div>
                        <div class="form-group">
                            <input type="text" name="celular" class="form-control" placeholder="Celular" required="true" maxlength="50">
                        </div>

                        <div class="form-group">
                            <select name="pais" id="pais" required="true" class="form-control">
                                <option value="">Seleccionar Pais</option>
                                @foreach($pais as $value)
                                    <option value="{{$value->codigo}}">{{$value->pais}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="ciudades" id="ciudades" required="true" class="form-control">
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" name="direccion" class="form-control" placeholder="Dirección" required="true">
                        </div>

                        <div class="form-group">
                            <input type="text" name="codigo" class="form-control" placeholder="Codido Postal Ej. 591" required="true" maxlength="200">
                        </div>

                        <div class="form-group">
                            <hr>
                        </div>

                        <div class="form-group">
                            <label>Fotografia 4x4 fondo plomo</label>
                            <input type="file" name="foto" class="form-control" required="true" accept=".jpg, .jepg, .png">
                        </div>

                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Crear Cuenta</button>
                        
                        <div class="register-link m-t-15 text-center">
                            <hr>
                            <p>¿Tienes una cuenta? <a href="{{route('index')}}">Iniciar Sesión</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function(){
            $('#pais').on('change',ciudad);
        });
        function ciudad(){
            var idciudad=$(this).val();
            if(! idciudad)
                $('#ciudades').html('<option value="">Seleccionar Ciudad</option>');
            else
            {

                $.get('https://svfhce.umsa.bo/sv/icp/api/ciudad/'+idciudad,function(data){
                var html_select='<option value="">Seleccionar Ciudad</option>';
                for(var i=0; i<data.length; ++i)
                    html_select+='<option value="'+data[i].codigociudad+'">'+data[i].ciudad+'</option>';

                $('#ciudades').html(html_select);

                });
            }
        }

    </script>
@endsection
