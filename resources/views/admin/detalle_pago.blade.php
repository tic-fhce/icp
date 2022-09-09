@extends('front.front_admin')

@section('metrix')
    <script type="text/javascript" src="https://h.online-metrix.net/fp/tags.js?org_id=<?php echo($icp->orgid);?>&session_id=redenlace_418809<?php echo($sessionID);?>" type="application/javascript"></script>
@endsection

@section('label1')
<noscript>
    <iframe style="width: 100px; height: 100px; border: 0; position: absolute; top: -5000px;" src="https://h.online-metrix.net/fp/tags.js?org_id={{$icp->orgid}}&session_id=redenlace_418809{{$sessionID}}"></iframe>
</noscript>

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
                        Detalle de Pagos
                    </div>
                    <div class="card-body">
                        <h4><strong class="card-title mb-3">{{$titulo}}</strong></h4>
                        <h3>{{$data->detalle}}</h3>
                        <label>Concepto : {{$pago->detalle}}</label><br>
                        <label>Costo : {{$pago->monto}}</label><br>
                        <label>Moneda : {{$pago->moneda}}</label><br>
                        <hr>
                        <div class="col-lg-6">
                        <form  id="payment_form" action="{{route('check')}}" method="post" >
                        @csrf
                            <input type="hidden" name="access_key" value="{{$icp->access_key}}">
                            <input type="hidden" name="profile_id" value="{{$icp->profile_id}}">
                            <input type="hidden" name="device_fingerprint_id" value="<?php echo($sessionID);?>">        
                            <input type="hidden" name="transaction_uuid" value="<?php echo uniqid()?>">

                            <input type="hidden" name="signed_field_names" value="access_key,profile_id,device_fingerprint_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,payment_method,bill_to_forename,bill_to_surname,bill_to_email,bill_to_phone,bill_to_address_line1,bill_to_address_city,bill_to_address_state,bill_to_address_country,bill_to_address_postal_code,merchant_defined_data1,merchant_defined_data4,merchant_defined_data6,merchant_defined_data7,merchant_defined_data9,merchant_defined_data11,merchant_defined_data15,merchant_defined_data87,merchant_defined_data88,merchant_defined_data90,merchant_defined_data91">

                            <input type="hidden" name="unsigned_field_names" value="card_type,card_number,card_expiry_date">
                            <input type="hidden" name="signed_date_time" value="<?php echo gmdate("Y-m-d\TH:i:s\Z"); ?>">

                            <input type="hidden" name="locale" value="es">

                            <input type="hidden" name="transaction_type" size="25" value="sale">
                                                
                            <input type="hidden" name="reference_number" id="reference_number" size="25" >

                            <input type="hidden" name="amount" size="25" value="{{$pago->monto}}">
                            <input type="hidden" name="currency" size="25" value="{{$pago->moneda}}">
                            <input type="hidden" name="payment_method" value="card">
                                                
                            <input type="hidden" name="merchant_defined_data11" required="true" value="{{$data->ci}}" maxlength="20">
                            <input type="hidden" name="bill_to_forename" required="true" value="{{$data->nombre}}">
                            <input type="hidden" name="bill_to_surname" required="true" value="{{$data->apellido}}">
                            <input type="hidden" name="bill_to_email" required="true" value="{{$data->correo}}">
                            <input type="hidden" name="bill_to_phone" value="{{$data->celular}}">

                            <input type="hidden" name="bill_to_address_line1" required="true" value="{{$data->direccion}}">
                                                
                            <input type="hidden" name="bill_to_address_country" required="true" value="{{$data->pais}}">
                            <input type="hidden" name="bill_to_address_state" value="{{$data->codigociudad}}">
                            <input type="hidden" name="bill_to_address_city" value="{{$data->ciudad}}">
                            <input type="hidden" name="bill_to_address_postal_code" required="true" value="{{$data->codigopostal}}">
                                                
                            <input type="hidden" name="merchant_defined_data1" value="SI">
                            <input type="hidden" name="merchant_defined_data4" value="<?php echo(date("d-m-y"));?>">
                            <input type="hidden" name="merchant_defined_data6" value="SI">
                            <input type="hidden" name="merchant_defined_data7" value="Postgrado-de-Humanidades{{$pago->id}}">
                            <input type="hidden" name="merchant_defined_data9" value="Sistema ICP">
                            <input type="hidden" name="merchant_defined_data15" value="{{$data->id_usuario}}">
                            <input type="hidden" name="merchant_defined_data87" value="{{$data->id_curso}}-{{$data->codigo}}">
                            <input type="hidden" name="merchant_defined_data88" value="jmmk">
                            <input type="hidden" name="merchant_defined_data90" value="{{$pago->detalle}}">
                            <input type="hidden" name="merchant_defined_data91" value="{{$pago->monto}}">

                            <input type="submit" id="submit" name="submit" value="Realizar Pago" class="btn btn-success btn-block" />

                        </form>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{route('estado')}}" class="btn btn-info btn-block">Salir</a>
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
        document.getElementById('reference_number').value=new Date().getTime();
    </script>
@endsection
