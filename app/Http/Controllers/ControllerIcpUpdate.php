<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;

class ControllerIcpUpdate extends Controller
{
    public function UpdatePass(Request $request){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $datos=$_SESSION['usuario'];

            $usuario=App\Usuario::findOrFail($datos->id);
            if(hash('ripemd160',$request->pass)==$usuario->pass)
            {
                $usuario->pass= hash('ripemd160',$request->pass2);
                $usuario->save();
                return back()->with('mensaje_success','La contraseña fue Actualizada Correctamente');
            }
            else             
                return back()->with('mensaje_error','La contraseña actual no coincide verifique e intente nuevamente');
        }
        else
            return redirect('/');
        
    }

    public function restPass($id_usuario){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $datos=$_SESSION['usuario'];

            $usuario=App\Usuario::findOrFail($id_usuario);
            $usuario->pass= hash('ripemd160',$usuario->usser);
            $usuario->save();
            return back()->with('mensaje_success','La contraseña fue Actualizada Correctamente');
        }
        else
            return redirect('/');
        
    }

    #MODULO PLAN 
    public function CerrarPlan($id_plan){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $plan=App\Plan::findOrFail($id_plan);
            $id_curso=$plan->id_curso;
            $plan->estado='0';
            $plan->save();
            return redirect(route('perfil_curso',$id_curso));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function AbrirPlan($id_plan){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $plan=App\Plan::findOrFail($id_plan);
            $id_curso=$plan->id_curso;
            $plan->estado='1';
            $plan->save();
            return redirect(route('perfil_curso',$id_curso));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function HabilitarPago($id_estudiante){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $estudiante=App\Estudiante::findOrFail($id_estudiante);
            $estudiante->habilitado="SI";
            $estudiante->save();
            return back()->with('mensaje_success','Estudiante Habilitado Correctamente');
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function CancelarPago($id_estudiante){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $estudiante=App\Estudiante::findOrFail($id_estudiante);
            $estudiante->habilitado="NO";
            $estudiante->save();

            return back()->with('mensaje_danger','Cuenta de pago del Estudiante Cancelada Correctamente Correctamente');
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function UpdatePago(Request $request){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $pago=App\Pago::findOrFail($request->id_pago);
            $pago->monto=$request->monto;
            $pago->estado=$request->estado;
            $pago->obs=$request->obs;
            if($request->estado=='1')
                $pago->fecha=$request->fecha;
            $pago->save();
            $atras=array('id_usuario'=>$request->id_usuario,'id_curso'=>$request->id_curso);
            return redirect(route('perfil',$atras));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function payment($estado,$id_transaction,$reference,$data4,$data7,$data15,$data87,$payer,$uuid,$auth_code){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $data=DB::table('view_data')->where('id_persona',$datos->id)->where('cursoestado','1')->first();
            $matricula=App\Matricula::all();
            
            if($estado=='1'){
                $id_pago=str_replace('Postgrado-de-Humanidades','',$data7);

                $pago= App\Pago::findOrFail($id_pago);

                $pago->estado=$estado;
                $pago->fecha=$data4;
                $pago->id_transaction=$id_transaction;
                $pago->nreferencia=$reference;
                $pago->data87=$data87;
                $pago->payer=$payer;
                $pago->uuid=$uuid;
                $pago->auth_code=$auth_code;
                $pago->save();
                
                $pago= App\Pago::findOrFail($id_pago);

                $payment=array('estado'=>$estado,'fecha'=>$pago->fecha,'id_transaction'=>$pago->id_transaction,'referencia'=>$pago->nreferencia,'data87'=>$pago->data87,'payer'=>$pago->payer,'uuid'=>$pago->uuid,'auth_code'=>$pago->auth_code,'monto'=>$pago->monto,'moneda'=>$pago->moneda,'detalle'=>$pago->detalle,'mensage'=>'Transaccion Aceptada','id_pago'=>$id_pago);

                $titulo="Transaccion Completa";
            }
            else{
                $payment=array('estado'=>$estado,'fecha'=>'Ninguna','id_transaction'=>'Ninguna','referencia'=>'Ninguna','data87'=>'Ninguna','payer'=>'Ninguna','uuid'=>'Ninguna','auth_code'=>'Ninguna','monto'=>'Sin Monto','moneda'=>'Ninguna','detalle'=>'Error de Transaccion','mensage'=>'Transaccion No Completada','id_pago'=>'0');

                $titulo="Error en la Transaccion";
            }

            $mensaje=$usuario->pass;
            return view('admin.recibo',compact('usuario','datos','titulo','mensaje','data','payment','matricula'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function Fincurso($id_estudiante){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $estudiante=App\Estudiante::findOrFail($id_estudiante);
            $estudiante->estado=2;
            $estudiante->save();
            return redirect('estado');
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function CerrarCurso($id_curso){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $curso=App\Curso::findOrFail($id_curso);
            $curso->estado='0';
            $curso->save();
            return back()->with('mensaje_success','Curso Cerrado Correctamente');
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function AbrirCurso($id_curso){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $curso=App\Curso::findOrFail($id_curso);
            $curso->estado='1';
            $curso->save();
            return back()->with('mensaje_success','Curso Reanudado Correctamente');
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function UpdatePlan(Request $request){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $plan=App\Plan::findOrFail($request->id_plan);
            $plan->detalle=$request->detalle;
            $plan->costo=$request->costo;
            $plan->save();
            return redirect(route('perfil_plan',$request->id_plan));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio
    public function UpdateCuota(Request $request){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $cuota=App\Cota::findOrFail($request->id_cuota);
            $cuota->nombre=$request->nombre;
            $cuota->monto=$request->monto;
            $cuota->save();
            return redirect(route('perfil_plan',$cuota->id_plan));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio
}
