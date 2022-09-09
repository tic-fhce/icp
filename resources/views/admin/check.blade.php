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
                                    <h2 class="text-white display-6">{{$data->codigo}}</h2>
                                    <p class="text-light">{{$data->matricula}}</p>
                                    <p class="text-light">Gestion : {{$data->gestion}}</p>
                                </div>
                            </div>
                        </div>
                  
                        <div class="weather-category twt-category">
                            
                        </div>
                        <footer class="twt-footer">
                            <h4><strong class="card-title mb-3">{{$titulo}}</strong></h4>
                            {{$data->detalle}}
                        </footer>
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
                        <h3>Información de la Tarjeta</h3> 
                    </div>
                    <div class="card-body">
                        <div class="col-lg-7"> 
                        <form id="payment_confirmation" action="https://secureacceptance.cybersource.com/silent/pay" method="post"/>
                        @csrf  
                        <div id="customer_details">
                            <?php
                                foreach($params as $name => $value) {
                                    echo "<input type=\"hidden\" id=\"" . $name . "\" name=\"" . $name . "\" value=\"" . $value . "\"/>\n";
                                            }
                                    echo "<input type=\"hidden\" id=\"signature\" name=\"signature\" value=\"" . sign($params) . "\"/>\n";
                            ?>

                            <div class="col-lg-6" align="center">
                                <label>
                                    <input type="radio" name="card_type" value="001" required="true">
                                    <img src="{{asset('images/visa.jpg')}}">
                                    <br>Visa
                                </label>
                            </div>
                            <div class="col-lg-6" align="center">
                                <label>
                                    <input type="radio" name="card_type" value="002" required="true">
                                    <img src="{{asset('images/master.jpg')}}">
                                    <br>MasterCard
                                </label>    
                            </div>
                                                    
                            <div class="col-lg-12"><hr></div>
                            
                            <div class="col-lg-12">                         
                                <div class="col-lg-4">
                                    <label>N° Tarjeta:</label>                            
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="card_number" id="card_number" value="" placeholder="XXXXXXXXXXXXXXXX" onkeyup="javascript:longitud()">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <br>
                            </div>

                            <div class="col-lg-12">                    
                                <div class="col-lg-4">    
                                    <label>CVV:</label>
                                    <img src="{{asset('images/cvv.jpg')}}">
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="card_security_code" placeholder="XXX" maxlength="3" required="true">
                                </div>
                            </div>

                            <div class="col-lg-12" align="center">
                                <hr>
                                <label>Fecha de Expiración</label>
                            </div>

                            <div class="col-lg-6">                        
                                <label> Mes 
                                <select id="mes" class="form-control" required="true" onclick="javascript:sumar()" onchange="javascript:sumar()">
                                    <option value="">Seleccionar Mes</option>
                                    @for($i=1; $i<=12 ; $i++)
                                        @if($i<=9)
                                            <?php $i="0".$i;?>
                                        @endif
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label> Año
                                    <select  class="form-control" required="true" id="year"  onclick="javascript:sumar()" onchange="javascript:sumar()">
                                        <option value="">Seleccionar Año</option>
                                        @for($i=2020; $i<=2035 ; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </label>
                            </div>

                            <div class="col-lg-12"><hr>
                                <input type="hidden" name="card_expiry_date" id="card_expiry_date"><br/>
                            </div>
                                          
                            <div class="col-lg-12">
                                <div class="col-md-5" align="center">
                                    <input type="submit" id="botonverifi" value="Confirmar" disabled="true"  class="btn btn-success btn-block"/>
                                </div>
                                <div class="col-md-2">
                                <br>
                                </div>
                                <div class="col-md-5" align="center">
                                    <a href="{{route('estado')}}" class="btn btn-warning btn-block">CANCELAR</a>
                                </div>
                            </div>
                        </div>

                        </form>
                        </div>
                        <div class="col-lg-5">
                            <h4><strong class="card-title mb-3">{{$titulo}}</strong></h4>
                            <hr>
                            <h4>{{$data->detalle}}</h4>
                            <hr>
                            <label>Concepto : Pago de {{$params['merchant_defined_data90']}}</label><br>
                            <label>Costo : {{$params['merchant_defined_data91']}}</label><br>
                            <label>Moneda : {{$params['currency']}}</label><br>
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
        function sumar() {
            mes = document.getElementById('mes').value;
            year = document.getElementById('year').value;            
            fecha = mes+"-"+year;
            document.getElementById('card_expiry_date').value=fecha;
        }
        function longitud(){
            n = document.getElementById('card_number').value;
            if(n.length==16)
            {
                document.getElementById('botonverifi').disabled=false;
                document.getElementById('botonverifi').value="Confirmar";
            }
            else{
                document.getElementById('botonverifi').disabled=true;
                document.getElementById('botonverifi').value="Tarjeta No Valida";
            }
        }
    </script>
@endsection
