<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;

class ControllerIcpRoute extends Controller
{
    //
    public function index(){
    	
    	return view('admin.login');

	}// funcion que muestra el inicio

	public function formulario_registro(){
		$pais=App\Pais::orderBy('pais','asc')->get();
		return view ('admin.formulario_registro',compact('pais'));
	}
	public function ciudad($idciudad){
		return App\Ciudad::where('codigo',$idciudad)->get();
	}

	

	public function AddEstudiante(Request $request){

		$ci=str_replace(' ','', $request->ci);
		$ci=strtolower($ci);
		$ci=str_replace('.','',$ci);

		$persona="";
		$persona=App\Persona::where('ci',$ci)->first();
		if($persona==""){

			$name=$request->file('foto')->store('public');
	        $name=str_replace('public/','', $name);


	        $persona=new App\Persona;
	        $persona->ci=$ci;
	        $persona->nombre=$request->nombre;
	        $persona->apellido=$request->apellido;
	        $persona->correo=$request->correo;
	        $persona->celular=$request->celular;
	        $persona->foto=$name;
	        $persona->save();

	        $persona=App\Persona::all();
            $idpersona=$persona->last();

            $datospago=new App\Datospago;
            $datospago->id_persona=$idpersona->id;
            $datospago->ci=$ci;
            $datospago->direccion=$request->direccion;
            $datospago->pais=$request->pais;
            $datospago->ciudad=$request->ciudades;
            $datospago->codigopostal=$request->codigo;
            $datospago->save();

            $usuario=new App\Usuario;
            $usuario->usser=$ci;
            $usuario->pass=hash('ripemd160',$ci);
            $usuario->tipo='3';
            $usuario->id_persona=$idpersona->id;
            $usuario->estado='1';
            $usuario->save();
            $mensage='s';

            $usuario=App\Usuario::all();
            $idusuario=$usuario->last();
            session_start();
        	$_SESSION['usuario']=$idusuario;
            return redirect(route('a691jmmk69866ef77e7b8719892ac8d64efde',$mensage));
		}
		else
			return back()->with('mensaje_error','Error el usuario ya existe, puede iniciar sesión con sus credenciales o comunicarse con soporte técnico para la habilitación de su cuenta.');
	}
}
