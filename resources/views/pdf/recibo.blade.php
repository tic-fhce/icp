<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ICP-Recibo</title>

</head>
<body>
<table border="0">
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
    <td colspan="2"><h3>Recibo de Transación</h3></td>
    <td colspan="2">
      Fecha : {{$pago->fecha}}<br>
      Order Number : {{$pago->nreferencia}}<br>
    </td>
  </tr>

  <tr>
    <td><strong>Datos :</strong><br>
    </td>
    <td colspan="2"> 
      {{$datos->nombre}} {{$datos->apellido}}<br>
      Direccion : {{$datos->direccion}}<br>
      Correo : {{$datos->correo}}<br>
      Tel-Cel :{{$datos->celular}}
    </td>
    <td></td>
  </tr>
</table>
<br>
<table border="1">
    <tr>
      <th width="20%">Código</th>
      <th width="40%">Detalle</th>
      
      <th >Cant.</th>
      <th >Precio</th>
      <th >Moneda</th>
      <th >Total</th>
    </tr>
    <tr>
        <td >{{$pago->id_transaction}}</td>
        <td >Pago de {{$pago->detalle}} {{$datos->detalle}}</td>
        <td >1</td>
        <td >{{$pago->monto}}</td>
        <td >{{$pago->moneda}}</td>
        <td > {{$pago->monto}} {{$pago->moneda}}</td>
    </tr>
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
        <td><strong>Total:</strong></td>
        <td>
          <h3>{{$pago->monto}} {{$pago->moneda}}</h3>
        </td>
    </tr>
    <tr>
        <td>
        </td>
        <td></td>
        <td>
          {{$pago->nreferencia}}
        </td>
    </tr>

  </table>
  </body>
</html>