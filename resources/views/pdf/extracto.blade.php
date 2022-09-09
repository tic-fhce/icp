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
    <td colspan="2"><h3>Extracto de Pagos y Deudas</h3></td>
    <td colspan="2">
      Fecha : <?php echo(date('Y/m/d'));?><br>
    </td>
  </tr>
  <tr>
    <td colspan="4">
      <h3>Datos</h3>
    </td>
  </tr>

  <tr>
    <td colspan="2" width="50%">
      
      Nombre : {{$datos->nombre}} {{$datos->apellido}}<br>
      Direccion : {{$datos->direccion}}<br>
      Correo : {{$datos->correo}}<br>
      Tel-Cel :{{$datos->celular}}
    </td>
    <td colspan="2" width="50%">
      Codigo : {{$datos->codigo}}<br>
      Curso : {{$datos->detalle}}<br>
      Gestion : {{$datos->gestion}}<br>
    </td>
  </tr>

</table>
<br>
<table border="1" width="100%" cellspacing=0 cellpadding=2 bordercolor="666633">
    <tr>
      <th width="10%">Código</th>
      <th width="20%">Detalle</th>
      <th >Monto</th>
      <th >Moneda</th>
      <th >Estado</th>
      <th >Fecha de Pago</th>
    </tr>
    <?php 
      $i=0;
      $c=0;
    ?>
    @foreach($pagos as $value)
      <?php $i=$i+$value->monto?>
      <tr>
        <td>{{$value->id}}</td>
        <td>{{$value->detalle}}</td>
        <td>{{$value->monto}}</td>
        <td>{{$value->moneda}}</td>
        <td>
          @if($value->estado=='0')
            Pendiente
          @else
            Pagado
            <?php $c=$c+$value->monto;?>
          @endif
        </td>
        <td>
          @if($value->estado=='0')
            Pendiente
          @else                                                            
            {{$value->fecha}}
          @endif
        </td>
      </tr>
    @endforeach
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
          Total a pagar : {{$i}} <br>
          Total pagado : {{$c}}<br>
          Deuda : {{$i-$c}}
        </td>
    </tr>
  </table>
  </body>
</html>