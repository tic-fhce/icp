<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;

class ControllerIcpPdf extends Controller
{
    public function Recibo($id_pago){

     	$pago=App\Pago::findOrfail($id_pago);
     	$datos=DB::table('view_lista_micurso')->where('id_persona',$pago->id_persona)->where('id_curso',$pago->id_curso)->first();
        
        $nameqr=$id_pago.'.png';

        $file=public_path('qr/'.$nameqr);

        //\QRCode::text($mensage)->setOutfile($file)->png();
        \QRCode::text($datos->nombre.' '.$datos->apellido.' '.$datos->direccion.' Pago por '.$pago->detalle.' '.$pago->monto.' '.$pago->moneda)->setOutfile($file)->png();

        $pdfrecibo=\PDF::loadView('pdf.recibo',compact('pago','datos','nameqr'));

        $name='recibo'.$pago->id.$datos->ci.'.pdf';
        //return view('pdf.recibo',compact('pago','datos','nameqr'));
        return $pdfrecibo->download($name);
    }

    public function Extracto($id_usuario,$id_curso){

        $usuario=App\Usuario::findOrfail($id_usuario);
        $datos=DB::table('view_lista_micurso')->where('id_persona',$usuario->id_persona)->where('id_curso',$id_curso)->first();
        $pagos=App\Pago::where('id_usuario',$id_usuario)->where('id_persona',$usuario->id_persona)->where('id_curso',$id_curso)->get();

        $nameqr=$id_curso.'.png';

        $file=public_path('qr/'.$nameqr);

        \QRCode::text($datos->nombre.' '.$datos->apellido.' '.$datos->direccion.' detalle '.$datos->detalle)->setOutfile($file)->png();

        $pdfrecibo=\PDF::loadView('pdf.extracto',compact('pagos','datos','nameqr'));

        $name='extracto'.$usuario->id.$datos->ci.'.pdf';
        //return view('pdf.extracto',compact('pagos','datos','nameqr'));
        return $pdfrecibo->download($name);
    }
    public function reporte($inicio,$fin,$moneda){
        session_start();
        if(isset($_SESSION['usuario']))
        {

            $usuario=$_SESSION['usuario'];
            $persona=App\Persona::findOrfail($usuario->id_persona);

            if($inicio!=0)
                $extracto=DB::table('view_extracto')->where('fech','>=',$inicio)->where('fech','<=',$fin)->where('moneda',$moneda)->orderBy('fech','ASC')->get();
            else
                $extracto=DB::table('view_extracto')->where('moneda',$moneda)->orderBy('fech','ASC')->get();
            

            $total=0;

            foreach($extracto as $value)
                $total=$total+$value->monto;

            $nameqr=$total.$persona->ci.'.png';

            $file=public_path('qr/'.$nameqr);

            \QRCode::text('Elavorado por : '.$persona->nombre.' '.$persona->apellido.' Total :'.$total.' '.$moneda)->setOutfile($file)->png();

            $pdfextracto=\PDF::loadView('pdf.extracto_pagos',compact('persona','extracto','nameqr','inicio','fin','moneda','total'))->setPaper('letter', 'landscape');

            $name='extracto'.$usuario->id.$persona->ci.'.pdf';
            //return view('pdf.extracto_pagos',compact('persona','extracto','nameqr','inicio','fin','moneda','total'));
            return $pdfextracto->download($name);
        }
        else
            return redirect('/');
    }

    public function notadocente($id_curso,$sigla){

        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $reporte=DB::table('modulos')->join('docentes','modulos.id_docente','=','docentes.id_persona')->join('personas','docentes.id_persona','=','personas.id')->where('modulos.id_curso',$id_curso)->where('modulos.sigla',$sigla)->select('*','modulos.nombre as modulos')->get();
            $notas=DB::table('notas')->join('personas','notas.id_estudiante','=','personas.id')->where('notas.sigla',$sigla)->where('notas.id_curso',$id_curso)->orderBy('personas.apellido','ASC')->get();
            $cursos=DB::table('modulos')->join('cursos','cursos.id','=','modulos.id_curso')->where('modulos.id_curso',$id_curso)->where('modulos.sigla',$sigla)->select('modulos.id_curso','modulos.sigla','modulos.nombre','cursos.detalle','cursos.gestion')->get();        
            //return response()->json($cursos);
            $pdfnota=\PDF::loadView('pdf.notasDocente',compact('reporte','notas','cursos'));
            $pdfnota->setPaper('Letter',"portrait");
            ini_set('max_execution_time', 300);
            return $pdfnota->stream('archivo.pdf');
        }
        else
            return redirect('/');
        
   }
   public function notadocenteh($id_curso,$sigla){

    session_start();
    if(isset($_SESSION['usuario']))
    {
        $usuario=$_SESSION['usuario'];
        $reporte=DB::table('modulohistorial')->join('cursohistorial','modulohistorial.id_cursohistorial','=','cursohistorial.id')->join('docentehistorial','modulohistorial.id_docentehistorial','=','docentehistorial.id')->where('modulohistorial.id',$sigla)->where('modulohistorial.id_cursohistorial',$id_curso)->get();
        $notas=DB::table('notahistorial')->join('estudiantehistorial','notahistorial.id_estudianteh','=','estudiantehistorial.id')->where('notahistorial.id_sigla',$sigla)->where('notahistorial.id_cursohistorial',$id_curso)->select('notahistorial.id_estudianteh','notahistorial.id_sigla','notahistorial.nota','estudiantehistorial.nombres','estudiantehistorial.apellidos')->get();
        //return response()->json($notas);
        //$cursos=DB::table('modulos')->join('cursos','cursos.id','=','modulos.id_curso')->where('modulos.id_curso',$id_curso)->where('modulos.sigla',$sigla)->select('modulos.id_curso','modulos.sigla','modulos.nombre','cursos.detalle','cursos.gestion')->get();        
        
        $pdfnota=\PDF::loadView('pdf.notasDocenteh',compact('reporte','notas'));
        $pdfnota->setPaper('Letter',"portrait");
        ini_set('max_execution_time', 300);
        return $pdfnota->stream('archivo.pdf');
    }
    else
        return redirect('/');
    
}
}
