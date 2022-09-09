<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;

class ControllerIcpAdd extends Controller
{
    #MODULO USUARIO
    public function AddUsuario(Request $request){

		$ci=str_replace(' ','', $request->ci);
		$ci=strtolower($ci);

		$persona="";
		$persona=App\Persona::where('ci',$ci)->first();
		if($persona==""){

	        $persona=new App\Persona;
	        $persona->ci=$ci;
	        $persona->nombre=$request->nombre;
	        $persona->apellido=$request->apellido;
	        $persona->correo=$request->correo;
	        $persona->celular=$request->celular;
	        $persona->foto='admin.png';
	        $persona->save();

	        $persona=App\Persona::all();
            $idpersona=$persona->last();

            $usuario=new App\Usuario;
            $usuario->usser=$request->correo;
            $usuario->pass=hash('ripemd160',$ci);
            $usuario->tipo=$request->tipo;
            $usuario->id_persona=$idpersona->id;
            $usuario->estado='1';
            $usuario->save();
            return redirect(route('lista_usuario'));
		}
		else
			return back()->with('mensaje_error','Error el usuario ya existe, Verifique e intente nuevamente.');
	}
	#MODULO CURSO
    public function AddCurso(Request $request){

		$curso=new App\Curso;
		$curso->codigo=$request->codigo;
		$curso->id_matricula=$request->tipo;
		$curso->detalle=$request->detalle;
		$curso->gestion=$request->gestion;
		$curso->estado='1';
	    $curso->save();

	    $curso=App\Curso::all();
	    $id_curso=$curso->last();

	    return redirect(route('perfil_curso',$id_curso->id));
		
	}

	public function AddPlan(Request $request){
		$moneda='USD';
		if($request->tipo=='Nacional')
			$moneda='BOB';

		$plan=new App\Plan;
		$plan->id_curso=$request->id_curso;
		$plan->codigo=$request->codigo;
		$plan->tipo=$request->tipo;
		$plan->nombre=$request->nombre;
		$plan->detalle=$request->detalle;
		$plan->costo=$request->costo;
		$plan->moneda=$moneda;
		$plan->estado='1';
	    $plan->save();
	    return redirect(route('perfil_curso',$request->id_curso));
		
	}

	public function AddCuota(Request $request){
		if($request->costo>0){
			$plan=App\Plan::findOrFail($request->id_plan);

			$costo=App\Cota::where('id_plan',$request->id_plan)->get();
			$total=$request->costo;
			foreach ($costo as $value) {
				$total=$total+$value->monto;
			}
			if($total<$plan->costo+1){
				$cuota=new App\Cota;
				$cuota->id_plan=$request->id_plan;
				$cuota->id_curso=$request->id_curso;
				$cuota->nombre=$request->nombre;
				$cuota->monto=$request->costo;
				$cuota->save();
			    return redirect(route('perfil_plan',$request->id_plan));	
			}
			else
				return back()->with('mensaje_error','No se puede agregar mas Cuotas, El costo incluido Sobrepasa el Costo Total');	
		}
		else
			return back()->with('mensaje_error','El Costo Tiene que ser mayor a 0');	
		
	}

	public function AddParalelo(Request $request){
		session_start();
        if(isset($_SESSION['usuario']))
        {
            //$registro=request()->except('_token');
            //return response()->json($registro);
			$paralelo=new App\Paralelo;
			$paralelo->id_curso=$request->id_curso;
            $paralelo->sigla=$request->sigla;
			$paralelo->codigo=$request->codigo;
			$paralelo->paralelo=$request->paralelo;
			$paralelo->estado='1';
			$paralelo->cupomin=$request->cupomin;
			$paralelo->cupomax=$request->cupomax;
			$paralelo->save();
		    return redirect(route('perfil_curso',$request->id_curso));	
		}
		else
            return redirect('/');
		
	}
	public function AddEstudianteCurso(Request $request){
		session_start();
        if(isset($_SESSION['usuario']))
        {

			$name=$request->file('folder')->store('public');
		    $name=str_replace('public/','', $name);

		    $estudiante=new App\Estudiante;
		    $estudiante->id_usuario=$request->id_usuario;
		    $estudiante->id_persona=$request->id_persona;
		    $estudiante->id_curso=$request->id_curso;
		    $estudiante->id_plan=0;
		    $estudiante->titulo=$request->titulo;
		    $estudiante->documento=$name;
		    $estudiante->estado=0;
		    $estudiante->habilitado='NO';
		    $estudiante->requisito='NO';
		    $estudiante->save();
		    return redirect(route('micurso'));	
		}
		else
            return redirect('/');
	}

	#

	public function CrearPlan($id_plan,$id_curso){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $plan=App\Plan::findOrFail($id_plan);

            $cotas=App\Cota::where('id_plan',$id_plan)->get();

            $datos=DB::table('view_lista_micurso')->where('id_usuario',$usuario->id)->where('id_persona',$usuario->id_persona)->where('id_curso',$id_curso)->first();

            $matricula=App\Matricula::findOrFail($datos->id_matricula);
            $estudiante=App\Estudiante::findOrFail($datos->id_estudiante);
            $estudiante->id_plan=$id_plan;
            $estudiante->estado=1;
            $estudiante->save();

            $pago=new App\Pago;
            $pago->id_usuario=$datos->id_usuario;
            $pago->id_curso=$id_curso;
            $pago->id_persona=$datos->id_persona;
            $pago->id_estudiante=$datos->id_estudiante;
            $pago->id_datospagos=$datos->id_datopago;
            $pago->fecha='0';
            $pago->detalle='Matricula';
            
            if($plan->moneda=='BOB')
                $pago->monto=$matricula->costo_n;
            else
                $pago->monto=$matricula->costo_i;
            
            $pago->moneda=$plan->moneda;
            $pago->estado='0';
            $pago->obs='Ninguna';
            $pago->id_transaction='0';
            $pago->nreferencia='0';
            $pago->data87='0';
            $pago->payer='0';
            $pago->uuid='0';
            $pago->auth_code='0';
            $pago->save();

            foreach ($cotas as $value) {
                $pago=new App\Pago;
                $pago->id_usuario=$datos->id_usuario;
                $pago->id_curso=$id_curso;
                $pago->id_persona=$datos->id_persona;
                $pago->id_estudiante=$datos->id_estudiante;
                $pago->id_datospagos=$datos->id_datopago;
                $pago->fecha='0';
                $pago->detalle=$value->nombre;
                $pago->monto=$value->monto;
                $pago->moneda=$plan->moneda;
                $pago->estado='0';
                $pago->obs='Ninguna';
                $pago->id_transaction='0';
	            $pago->nreferencia='0';
	            $pago->data87='0';
	            $pago->payer='0';
	            $pago->uuid='0';
	            $pago->auth_code='0';
                $pago->save();
            }

            return redirect('estado');
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function AddPago(Request $request){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $plan=App\Plan::findOrFail($request->id_plan);

            $pago= new App\Pago;
            $pago->id_usuario=$request->id_usuario;
            $pago->id_curso=$request->id_curso;
            $pago->id_persona=$request->id_persona;
            $pago->id_estudiante=$request->id_estudiante;
            $pago->id_datospagos=$request->id_datopago;
            $pago->detalle=$request->detalle;
            $pago->monto=$request->monto;
            $pago->moneda=$plan->moneda;
            $pago->estado='0';
            $pago->fecha='0';
            $pago->obs='Ninguna';
            $pago->id_transaction='0';
	        $pago->nreferencia='0';
	        $pago->data87='0';
	        $pago->payer='0';
	        $pago->uuid='0';
	        $pago->auth_code='0';
            $pago->save();
            
            $atras=array('id_usuario'=>$request->id_usuario,'id_curso'=>$request->id_curso);

            return redirect(route('perfil',$atras));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    #######################################################
    #MODULO REGION
    public function AddPais(Request $request){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $codigo=strtoupper($request->codigo);

            $pais=App\Pais::where('codigo',$codigo)->get();
            $c=0;
            foreach($pais as $value)
                $c=$c+1;

            if($c==0){
                $pais=new App\Pais;
                $pais->codigo=$codigo;
                $pais->pais=strtoupper($request->pais);
                $pais->save();
                return redirect(route('formulario_Ciudad',$codigo));
            }
            else
                return back()->with('mensaje','El Codigo del Pais ya existe');
        }
        else
            return redirect('/');
    }
    
    public function AddCiudad(Request $request){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $codigo=strtoupper($request->codigociudad);

            $ciudad=App\Ciudad::where('codigociudad',$codigo)->get();
            $c=0;
            foreach($ciudad as $value)
                $c=$c+1;

            if($c==0){
                $ciudad=new App\Ciudad;
                $ciudad->codigo=$request->codigo;
                $ciudad->codigociudad=$codigo;
                $ciudad->ciudad=$request->ciudad;
                $ciudad->save();
                return redirect(route('formulario_Ciudad',$request->codigo));
            }
            else
                return back()->with('mensaje','El Codigo de la Ciudad ya existe');
        }
        else
            return redirect('/');
    }

    public function AddDocente(Request $request){
        
        //$registro=request()->except('_token');
        //return response()->json($registro);
		$ci=str_replace(' ','', $request->ci);
		$ci=strtolower($ci);

		$persona="";
		$persona=App\Persona::where('ci',$ci)->first();
		if($persona==""){

	        $persona=new App\Persona;
	        $persona->ci=$ci;
	        $persona->nombre=$request->nombre;
	        $persona->apellido=$request->apellido;
	        $persona->correo=$request->correo;
	        $persona->celular=$request->celular;
	        $persona->foto='admin.png';
	        $persona->save();

	        $persona=App\Persona::all();
            $idpersona=$persona->last();

            $usuario=new App\Usuario;
            $usuario->usser=$request->correo;
            $usuario->pass=hash('ripemd160',$ci);
            $usuario->tipo='4';
            $usuario->id_persona=$idpersona->id;
            $usuario->estado='1';
            $usuario->save();

            $docente=new App\Docente;
            $docente->id_usuario=$idpersona->id;
            $docente->id_persona=$idpersona->id;
            $docente->ga=$request->ga;
            $docente->save();
            return redirect()->route('lista_docente');
		}
		else
			return back()->with('mensaje_error','Error el usuario ya existe, Verifique e intente nuevamente.');
	}
}
