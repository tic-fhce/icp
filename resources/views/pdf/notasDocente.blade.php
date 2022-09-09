<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ICP-Recibo</title>
    <style>
			*{
				font-family: Roboto;
				font-style: normal;
        font-weight: normal;
			}
      .titulo{
        font-size: 20px;
        line-height: 24px;
        text-align: center;
        color: #D10A0A;
      }
      .subtitulos{
        font-size: 14px;
        line-height: 17px;
        text-align: center;

        color: #D10A0A;
      }
			.container{
				display: flex;
				flex-direction: row;
				justify-content: center;
    		align-items: flex-start;
    		align-content: center;
			}
			.imgizq{
				margin-top:0px;
				margin-left:5px;
				width: 100px;
				padding-left: 20px;
			}
			.imgder{
				margin: 10px;
    		margin-top: 24px;
				margin-left: 20px;
    		width: 70px;
				padding-right: 30px;
			}
    </style>
</head>
<body>
	<div class="container">
		<table border="0" width="100%">
			<tr>
				<td width="20%"><img class="imgizq" src="{{asset('./images/iconopg.png')}}"></td>
				<td width="60%"><p class="titulo">ACTA DE CALIFICACIONES</p>
					<p class="subtitulos">UNIDAD DE POSTGRADO HUMANIDADES U.M.S.A.</p>
					@foreach ($cursos as $value)
					<p class="subtitulos">{{$value->detalle}}</p>
					<p class="subtitulos">Modulo: {{$value->nombre}}</p>
					@endforeach</td>
				<td width="20%"><img class="imgder" src="{{asset('./images/logou.png')}}"></td>
			</tr>
		</table>
	</div>
	
	<table border="0" width="100%">
		<tr>
			@foreach ($reporte as $value)
			<td colspan="2">Docente: {{$value->ga}} {{$value->nombre}} {{$value->apellido}}</td>
			@endforeach
			
		</tr>
		<tr>
			<?php $cont=0;?>
			@foreach ($notas as $value)
				<?php $cont=$cont+1; ?>
			@endforeach
			<td>No. de Estudiantes: <?php echo ($cont)?></td>
			@foreach ($cursos as $value)
			<td>Gestión: {{Str::limit($value->gestion, 4," ")}}</td>
			@endforeach

		</tr>
	</table>
  <br>
  
  
  <table border="1" width="100%" cellspacing=0 cellpadding=2 bordercolor="666633">
    <tbody>
      <tr>
        <th rowspan="2">N°</th>
        <th rowspan="2">APELLIDOS</th>
        <th rowspan="2">NOMBRES</th>
        <th colspan="2">NOTAS</th>
      </tr>
      <tr>
        <th>NUMERAL</th>
        <th>LITERAL</th>
      </tr>
      
        @foreach ($notas as $value)
        <tr style="font-size: 13px">
        <td align="center">{{$loop->iteration}}</td>
        <td style="text-transform: uppercase;">{{$value->apellido}}</td>
        <td style="text-transform: uppercase;">{{$value->nombre}}</td>
        <td align="center">{{$value->notaFinal}}</td>
        <td align="center">
          <?php $resultado = convertir($value->notaFinal);
            echo $resultado;
          ?>
        </td>
        </tr>
        @endforeach
    </tbody>
  </table>
	<br>
	<table border="0" width="100%" cellspacing=0 cellpadding=2 bordercolor="666633">
    <tbody>
      <tr style="font-size: 12px">
        <th rowspan="2">ESCALA DE NOTAS</th>
        <th>0 - 65</th>
        <th>66 - 70</th>
        <th>71 - 80</th>
				<th>81 - 90</th>
				<th>91 - 100</th>
      </tr>
      <tr style="font-size: 12px">
        <th>Reprobado</th>
        <th>Aprobado</th>
				<th>Buen logro</th>
				<th>Sobresaliente</th>
				<th>Excelente</th>
      </tr>
    </tbody>
  </table>
	<br>
	<br>
	<br>
	<table border="0" width="100%" cellspacing=0 cellpadding=2 bordercolor="666633">
    <tbody>
      <tr>
        <th><hr width=50%  align="center"></th>
        <th><hr width=50%  align="center"></th>
      </tr>
      <tr style="font-size: 12px">
				@foreach ( $reporte as $value)
				<th>{{$value->ga}} {{$value->nombre}} {{$value->apellido}}</th>
				@endforeach
        
        <th></th>
				<th></th>
      </tr>
			<tr style="font-size: 12px">
        <th>DOCENTE DE POSTGRADO</th>
        <th>COORDINADOR DE POSTGRADO</th>
      </tr>
    </tbody>
  </table>
</body>
</html>
<?php
function centena($numeros){
	if ($numeros == 100)
		{
			$numc = "CIEN ";
		}
		else {
			$numc = decena($numeros);
		}
		return $numc;
}
function unidad($numuero){
	switch ($numuero)
	{
		case 9:
		{
			$numu = "NUEVE";
			break;
		}
		case 8:
		{
			$numu = "OCHO";
			break;
		}
		case 7:
		{
			$numu = "SIETE";
			break;
		}
		case 6:
		{
			$numu = "SEIS";
			break;
		}
		case 5:
		{
			$numu = "CINCO";
			break;
		}
		case 4:
		{
			$numu = "CUATRO";
			break;
		}
		case 3:
		{
			$numu = "TRES";
			break;
		}
		case 2:
		{
			$numu = "DOS";
			break;
		}
		case 1:
		{
			$numu = "UNO";
			break;
		}
		case 0:
		{
			$numu = "CERO";
			break;
		}
	}
	return $numu;
}
 
function decena($numdero){
 
		if ($numdero >= 90 && $numdero <= 99)
		{
			$numd = "NOVENTA ";
			if ($numdero > 90)
				$numd = $numd."Y ".(unidad($numdero - 90));
		}
		else if ($numdero >= 80 && $numdero <= 89)
		{
			$numd = "OCHENTA ";
			if ($numdero > 80)
				$numd = $numd."Y ".(unidad($numdero - 80));
		}
		else if ($numdero >= 70 && $numdero <= 79)
		{
			$numd = "SETENTA ";
			if ($numdero > 70)
				$numd = $numd."Y ".(unidad($numdero - 70));
		}
		else if ($numdero >= 60 && $numdero <= 69)
		{
			$numd = "SESENTA ";
			if ($numdero > 60)
				$numd = $numd."Y ".(unidad($numdero - 60));
		}
		else if ($numdero >= 50 && $numdero <= 59)
		{
			$numd = "CINCUENTA ";
			if ($numdero > 50)
				$numd = $numd."Y ".(unidad($numdero - 50));
		}
		else if ($numdero >= 40 && $numdero <= 49)
		{
			$numd = "CUARENTA ";
			if ($numdero > 40)
				$numd = $numd."Y ".(unidad($numdero - 40));
		}
		else if ($numdero >= 30 && $numdero <= 39)
		{
			$numd = "TREINTA ";
			if ($numdero > 30)
				$numd = $numd."Y ".(unidad($numdero - 30));
		}
		else if ($numdero >= 20 && $numdero <= 29)
		{
			if ($numdero == 20)
				$numd = "VEINTE ";
			else
				$numd = "VEINTI".(unidad($numdero - 20));
		}
		else if ($numdero >= 10 && $numdero <= 19)
		{
			switch ($numdero){
			case 10:
			{
				$numd = "DIEZ ";
				break;
			}
			case 11:
			{
				$numd = "ONCE ";
				break;
			}
			case 12:
			{
				$numd = "DOCE ";
				break;
			}
			case 13:
			{
				$numd = "TRECE ";
				break;
			}
			case 14:
			{
				$numd = "CATORCE ";
				break;
			}
			case 15:
			{
				$numd = "QUINCE ";
				break;
			}
			case 16:
			{
				$numd = "DIECISEIS ";
				break;
			}
			case 17:
			{
				$numd = "DIECISIETE ";
				break;
			}
			case 18:
			{
				$numd = "DIECIOCHO ";
				break;
			}
			case 19:
			{
				$numd = "DIECINUEVE ";
				break;
			}
			}
		}
		else
			$numd = unidad($numdero);
	return $numd;
}
function convertir($numero){
		   $numf = centena($numero);
		return $numf;
}
?>