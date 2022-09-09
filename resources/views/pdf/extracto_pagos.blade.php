<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ICP-Extracto</title>

</head>
<body>
<table border="0" width="100%">
  <tr>
    <td width="100px"> <img src="{{asset('images/iconopg.png')}}" width="100px" height="100px"></td>
    <td>
      <strong>Interfaz de Cobro Postgrado Humanidades</strong><br>
      Unidad de Postgrado<br>
      La paz - Bolivia<br>
    </td>
    <td>
      Web: fhce.umsa.bo/postgrado<br>
      E-mail: postgrado.fhce@umsa.bo<br>
      Tel: <br>
    </td>
    <td align="right">
        <img src="{{asset('qr/'.$nameqr)}}" width="100px" height="100px">
    </td>
  </tr>

  <tr>
    <td colspan="2">
      @if($inicio!='0')
        <h3>Extracto de Pagos del {{$inicio}} al {{$fin}}</h3>
      @else 
        <h3>Extracto de Pagos</h3>
      @endif
    </td>
    <td colspan="2">
      Fecha : <?php echo(date('Y/m/d'));?><br>
    </td>
  </tr>
  <tr>
    <td colspan="4">
      <h3>Elavorado por :</h3>
    </td>
  </tr>

  <tr>
    <td colspan="2" width="50%">
      
      Nombre : {{$persona->nombre}} {{$persona->apellido}}<br>
      Correo : {{$persona->correo}}<br>
      Tel-Cel :{{$persona->celular}}
    </td>
    <td colspan="2" width="50%">
      
    </td>
  </tr>

</table>
<br>
<table border="1" width="100%" cellspacing=0 cellpadding=2 bordercolor="666633">
    <tr>
      <th>#</th>
      <th>ID Pago</th>
      <th>C.I.</th>
      <th>Cliente</th>
      <th width="30%">Detalle</th>
      <th>Concepto</th>
      <th>Monto</th>
      <th>ID Transaccion</th>
      <th>Numero de Referencia</th>
      <th>UUID</th>
      <th>Fecha de Pago</th>
    </tr>
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
      <td><font size="10px">{{$value->ci}}</font></td>                                    
      <td><font size="9px">{{$value->nombre}} {{$value->apellido}}</font></td>
      <td><font size="9px">{{$value->detalle}}</font></td>
      <td><font size="10px">{{$value->concepto}} {{$value->matricula}}</font></td>
      <td>{{$value->monto}} {{$value->moneda}}</td>
      <td><font size="9px">{{$value->id_transaction}}</font></td>
      <td><font size="9px">{{$value->nreferencia}}</font></td>
      <td><font size="9px">{{$value->uuid}}</font></td>
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
  <hr>
  <br>
  <table border="0" width="100%">
    <tr>
        <td>
          UMSA Facultad de Humanidades y Ciencias de la Educación<br>
          Casa Marcelo Quiroga Santa Cruz<br>
          Avenida 6 de agosto<br>
          N° 2118 La Paz - Bolivia 
        </td>
        <td>
          <h2>Total : {{$total}} {{$moneda}}</h2>
          
        </td>
    </tr>
  </table>
  </body>
</html>