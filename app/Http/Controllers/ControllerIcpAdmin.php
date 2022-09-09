<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;

class ControllerIcpAdmin extends Controller
{
    ## MODULOS USUARIO
    public function login(Request $request){
    	
    	$admin="";
       	$pass= hash('ripemd160',$request->pass);
        $admin = App\Usuario::where('usser', $request->usser)->where('pass',$pass)->first();

        if($admin==""){
        	session_start();	
        	session_destroy();
            return back()->with('mensaje_error','Error usuario no identificado');
        }
        else
        {
        	session_start();
        	$_SESSION['usuario']=$admin;
            $mensaje=hash('ripemd160',$admin->pass);
            return redirect(route('a691jmmk69866ef77e7b8719892ac8d64efde',$mensaje));// redirecciona a secion
        }
        

	}// funcion que autentica al usuario

	public function a691jmmk69866ef77e7b8719892ac8d64efde($m){
    	session_start();
    	if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $titulo="Escritorio";
            $mensaje=$m;
            $matricula=App\Matricula::all();
            return view('admin.panel',compact('usuario','datos','titulo','mensaje','matricula'));
        }
    	else
        	return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function salir(){
    	session_start();
        if(isset($_SESSION['usuario'])){
            $datos=$_SESSION['usuario'];
            session_destroy();
        }
        return redirect('/');
    }// funcion que cierra el inicio de secion


    
    public function formularioUpdatePass(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $titulo="Actualizar Contraseña";
            $mensaje=$usuario->pass;
            $matricula=App\Matricula::all();
            return view('admin.formulario_update_pass',compact('usuario','datos','titulo','mensaje','matricula'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

#MODULO USUARIOS
    public function formulario_usuario(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $titulo="Crear Usuario"; 
            $mensaje=$usuario->pass;
            return view('admin.formulario_usuario',compact('usuario','datos','titulo','mensaje'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function lista_usuario(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $lista=DB::table('view_usuario')->get();
            $titulo="Lista de Usuarios";
            $mensaje=$usuario->pass;
            return view('listas.lista_usuario',compact('usuario','datos','titulo','lista','mensaje'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function perfil($id_usuario,$id_curso){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first(); // usuario administrador
            $perfil=DB::table('view_lista_estudiante')->where('id_usuario',$id_usuario)->where('id_curso',$id_curso)->first();
            $titulo='Perfil del Usuario : '.$perfil->nombre;

            $pago=App\Pago::where('id_persona',$perfil->id_persona)->where('id_datospagos',$perfil->id_datospago)->where('id_curso',$perfil->id_curso)->get();
            
            $mensaje=$usuario->pass;
            $matricula=App\Matricula::all();

            return view('admin.perfil',compact('usuario','datos','titulo','perfil','mensaje','pago','matricula'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function addNota($id_usuario,$id_curso,$sigla){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first(); // usuario administrador
            $perfil=DB::table('view_lista_estudiante')->where('id_usuario',$id_usuario)->where('id_curso',$id_curso)->first();
            $titulo='Perfil del Usuario : '.$perfil->nombre;
            $mensaje=$usuario->pass;
            $matricula=App\Matricula::all();
            $modulo=App\Modulos::where('id_curso',$id_curso)->where('sigla',$sigla)->get();
            //return response()->json($modulo);
            return view('admin.addNota',compact('usuario','datos','titulo','perfil','mensaje','matricula','modulo'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio
    
    public function registraNota(Request $request){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $request->validate([
            'notaFinal'=>'required|numeric',                
            ]);
            $registro=request()->except('_token');
            $cursando = array('id_curso'=>$request->id_curso,'sigla'=>$request->sigla);
            $id_curso=$request->id_curso;
            $estudiante=App\Persona::where('id',$request->id_estudiante)->first();
            // return response()->json($estudiante);
            $verificar=App\Notas::where('id_curso',$request->id_curso)->where('sigla',$request->sigla)->where('id_estudiante',$request->id_estudiante)->first(); 
            if($verificar!=''){
                return back()->with('info','La Nota Final Ya fue Registrado!!.');
            }
            else{
                
                App\Notas::create($registro);
                return redirect()->route('lista_estudiantem',$cursando)->with('info','La Nota Final del estudiante: '.$estudiante->nombre.' '.$estudiante->apellido.' fue guardado con exito!!.');
            }
            
            //
        }
        else
            return redirect('/');
    }
    
    public function perfil_usuario($id_usuario){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first(); // usuario administrador
            $perfil=DB::table('view_usuario')->where('id_usuario',$id_usuario)->first();
            $titulo='Perfil del Usuario : '.$perfil->nombre;
            $mensaje=$usuario->pass;
            return view('admin.perfil_usuario',compact('usuario','datos','titulo','perfil','mensaje'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    #MODULO CURSO
    public function formulario_curso(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $matricula=App\Matricula::all();
            $titulo="Crear Curso";
            $mensaje=$usuario->pass;
            return view('admin.formulario_curso',compact('usuario','datos','titulo','mensaje','matricula'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function lista_curso(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            
            $lista=DB::table('view_lista_cusos')->orderBy('id_curso','DESC')->get();

            $titulo="Lista de Cursos";
            $mensaje=$usuario->pass;
            return view('listas.lista_curso',compact('usuario','datos','titulo','lista','mensaje'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function perfil_curso($id_curso){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $curso=App\Curso::findOrFail($id_curso);
            $plan=App\Plan::where('id_curso',$id_curso)->get();
            $titulo="Curso ".$curso->codigo;
            $mensaje=$usuario->pass;
            $paralelo=App\Paralelo::where('id_curso',$id_curso)->get();
            $modulo=App\Modulos::where('id_curso',$id_curso)->get();
            $docente=DB::table('docentes')->join('personas', 'docentes.id_persona', '=', 'personas.id')->select('*')->get();
            $moduloR=DB::table('modulos')->join('docentes','docentes.id_persona','=','modulos.id_docente')
            ->join('personas','personas.id','=','docentes.id_persona')->select('*','modulos.nombre as curso')->where('id_curso',$id_curso)->get();
            //return response()->json($moduloR);
            return view('admin.perfil_curso',compact('usuario','datos','titulo','mensaje','curso','plan','paralelo','modulo','docente','moduloR'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function perfil_plan($id_plan){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $plan=App\Plan::findOrFail($id_plan);
            $curso=App\Curso::findOrFail($plan->id_curso);
            $cuota=App\Cota::where('id_plan',$id_plan)->where('id_curso',$curso->id)->get();
            $titulo="Curso ".$curso->codigo." \Plan de Pago ".$plan->nombre;
            $mensaje=$usuario->pass;
            return view('admin.perfil_plan',compact('usuario','datos','titulo','mensaje','curso','plan','cuota'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    ###########################################333
    #MODULO REGION

    public function formulario_Region(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $titulo='Adicionar Nuevo Pais';
            $titulo2=$usuario->usser;
            return view('admin.formulario_region',compact('usuario','datos','titulo','titulo2'));
        }
        else
            return redirect('/');
    }// funcion muestra el formulario de los paices

    public function formulario_Ciudad($codigo){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $pais=App\Pais::where('codigo',$codigo)->first();
            $ciudad=App\Ciudad::where('codigo',$codigo)->get();
            $titulo='Adicionar Ciudades de '.$pais->pais;
            $titulo2=$usuario->usser;
            return view('admin.formulario_ciudad',compact('usuario','datos','titulo','titulo2','pais','ciudad'));
        }
        else
            return redirect('/');
    }// funcion muestra el formulario de los paices

    public function listaRegion(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $pais=App\Pais::all();
            $titulo='Paices Registrados';
            $titulo2=$usuario->usser;
            return view('listas.region',compact('usuario','datos','titulo','titulo2','pais'));
        }
        else
            return redirect('/');
    }// funcion muestra el formulario de los paices



    #MODULO ESTUDIANTE
    public function lista_estudiante($id_curso){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            if($id_curso==0)
                $lista=DB::table('view_lista_estudiante')->where('tipo','3')->orderBy('habilitado','asc')->get();
            else 
                $lista=DB::table('view_lista_estudiante')->where('tipo','3')->where('id_curso',$id_curso)->orderBy('apellido','asc')->get();
            $titulo="Lista de Usuarios";
            $pagos=DB::table('pagos')->get();
            $mensaje=$usuario->pass;
            //return response()->json($pagos);
            return view('listas.lista_estudiante',compact('usuario','datos','titulo','lista','mensaje','pagos'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function oferta($id_matricula){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $matricula=App\Matricula::all();
            if($id_matricula==0)
                $curso=App\Curso::where('estado','1')->get();
            else
                $curso=App\Curso::where('id_matricula',$id_matricula)->where('estado','1')->get();
            $titulo="Oferta Académica";
            $mensaje='s';
            return view('admin.oferta',compact('usuario','datos','titulo','curso','mensaje','matricula'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function perfil_curso_oferta($id_curso){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $curso=App\Curso::findOrFail($id_curso);
            $plan=App\Plan::where('id_curso',$id_curso)->get();
            $titulo="Curso ".$curso->codigo;
            $mensaje='s';
            $paralelo=App\Paralelo::where('id_curso',$id_curso)->get();
            $matricula=App\Matricula::all();
            return view('admin.perfil_curso_oferta',compact('usuario','datos','titulo','mensaje','curso','plan','paralelo','matricula'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function estado(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $matricula=App\Matricula::all();
            $curso='';
            $curso=DB::table('view_lista_micurso')->where('id_persona',$datos->id)->where('id_usuario',$usuario->id)->where('habilitado','SI')->where('estado_estudiante',1)->first(); 
            if($curso!=''){
                $pagos=App\Pago::where('id_usuario',$usuario->id)->where('id_persona',$datos->id)->where('id_curso',$curso->id_curso)->get();
                $titulo="Inscrito(a)";
                $uri= array('id_usuario'=>$usuario->id,'id_curso'=>$curso->id_curso);
                $nota =DB::table('notas')->join('modulos', 'notas.sigla', '=', 'modulos.sigla')->where('id_estudiante',$usuario->id)->select('notas.sigla', 'modulos.nombre', 'notas.notaFinal')->get();
                //return response()->json($nota);
                return view('admin.panel_estudiante',compact('usuario','datos','titulo','pagos','curso','matricula','uri','nota'));
            }
            else
                return redirect('micurso');
        }
        else
            return redirect('/');

    }// funcion para pagar las cuotas del curso

    public function estadocurso($id_curso){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $matricula=App\Matricula::all();
            $curso='';
            $curso=DB::table('view_lista_micurso')->where('id_curso',$id_curso)->where('id_persona',$datos->id)->where('id_usuario',$usuario->id)->where('habilitado','SI')->where('estado_estudiante',1)->first(); 
            if($curso!=''){
                $pagos=App\Pago::where('id_usuario',$usuario->id)->where('id_persona',$datos->id)->where('id_curso',$curso->id_curso)->get();
                $titulo="Inscrito(a)";
                $uri= array('id_usuario'=>$usuario->id,'id_curso'=>$curso->id_curso);
                $nota =DB::table('notas')->join('modulos', 'notas.sigla', '=', 'modulos.sigla')->where('id_estudiante',$usuario->id)->select('notas.sigla', 'modulos.nombre', 'notas.notaFinal')->get();
                //return response()->json($pagos);
                return view('admin.panel_estudiante',compact('usuario','datos','titulo','pagos','curso','matricula','uri','nota'));
            }
            else
                return redirect('micurso');
        }
        else
            return redirect('/');
    }


    public function micurso(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $curso='';
            $pagos='';

            $curso=DB::table('view_lista_micurso')->where('id_persona',$datos->id)->where('id_usuario',$usuario->id)->where('estado_estudiante',0)->first();

            if($curso!=''){
                $plan=App\Plan::where('id_curso',$curso->id_curso)->where('estado','1')->get();
                $titulo="Curso ".$curso->codigo;
                $mensaje=$usuario->pass;
                $paralelo=App\Paralelo::where('id_curso',$curso->id_curso)->get();
                $matricula=App\Matricula::all();
                return view('admin.perfil_mi_curso',compact('usuario','datos','titulo','mensaje','curso','plan','paralelo','matricula'));
            }
            else{
                return redirect(route('oferta',0));
            }

        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function estracto($id_curso){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $matricula=App\Matricula::all();
            $curso=DB::table('view_lista_micurso')->where('id_persona',$datos->id)->where('id_usuario',$usuario->id)->where('id_curso',$id_curso)->first();
            $pagos=App\Pago::where('id_usuario',$usuario->id)->where('id_persona',$datos->id)->where('id_curso',$id_curso)->get();
            $titulo="Inscrito(a)";
            $uri= array('id_usuario' =>$usuario->id,'id_curso'=>$curso->id_curso);
            return view('admin.panel_estudiante_extracto',compact('usuario','datos','titulo','mensaje','pagos','curso','matricula','uri'));
        }
        else
            return redirect('/');
    }// funcion para pagar las cuotas del curso

    public function listaCursos(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $cursos=DB::table('view_lista_micurso')->where('id_persona',$datos->id)->where('id_usuario',$usuario->id)->get();
            $titulo="Mis Cursos";
            $mensaje=$usuario->pass;
            $matricula=App\Matricula::all();
            return view('listas.lista_mi_curso',compact('usuario','datos','titulo','mensaje','cursos','matricula'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function DetallePago($id_pago){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            
            $sessionID = uniqid();
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $icp=App\Icp::findOrFail(1);
            $data=DB::table('view_data')->where('id_persona',$datos->id)->where('cursoestado','1')->first();
            $plan=App\Plan::findOrFail($data->id_plan);
            $pago=App\Pago::findOrFail($id_pago);
            $titulo="Curso ".$data->codigo;
            $mensaje=$usuario->pass;
            $matricula=App\Matricula::all();
            return view('admin.detalle_pago',compact('usuario','datos','titulo','mensaje','matricula','data','plan','pago','icp','sessionID')); 
        }
        else{
            return redirect('/');
        }
    }// funcion que muestra el inicio de secion

    public function check(Request $request){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            foreach($_REQUEST as $name => $value) {
                $params[$name] = $value;
            }
            $data=DB::table('view_data')->where('id_persona',$datos->id)->where('cursoestado','1')->first();
            $titulo="Pago de Curso ".$data->codigo;
            $mensaje=$usuario->pass;
            $matricula=App\Matricula::all();
            return view('admin.check',compact('usuario','datos','titulo','mensaje','matricula','params','data'));
        }
        else{
            return redirect('/');
        }
    }


    #MODULO PLAN
    public function FormularioUpdatePago($id_usuario,$id_pago){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $estudiante=App\Usuario::where('id',$id_usuario)->first();
            $perfil=DB::table('view_lista_micurso')->where('id_usuario',$id_usuario)->where('id_persona',$estudiante->id_persona)->where('estado_estudiante',1)->first();
            $titulo='Perfil del Usuario : '.$perfil->nombre;
            $pago=App\Pago::findOrFail($id_pago);
            $mensaje=$usuario->pass;
            return view('admin.formulario_update_pago',compact('usuario','datos','titulo','perfil','mensaje','pago'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function reciboafter($id_pago){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $pago=App\Pago::findOrFail($id_pago);

            $matricula=App\Matricula::all();
            $data=DB::table('view_data')->where('id_persona',$datos->id)->where('id_estudiante',$pago->id_estudiante)->first();
            $titulo="Transaccion Completa";
            $mensaje=$usuario->pass;
            return view('admin.reciboafter',compact('usuario','datos','titulo','mensaje','data','pago','matricula'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio
    public function formulario_update_plan($id_plan){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $plan=App\Plan::findOrFail($id_plan);

            $matricula=App\Matricula::all();
            $titulo="Editar plan";
            $mensaje=$usuario->pass;
            return view('admin.formulario_update_plan',compact('usuario','datos','titulo','mensaje','matricula','plan'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio
    public function formulario_update_cuota($id_cuota){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $cuota=App\Cota::findOrFail($id_cuota);

            $matricula=App\Matricula::all();
            $titulo="Editar Cuota";
            $mensaje=$usuario->pass;
            return view('admin.formulario_update_cuota',compact('usuario','datos','titulo','mensaje','matricula','cuota'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    
    #MODULO REPOSRTES

    public function formulario_por_fechas(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $titulo="Estracto de Pagos por Fechas";
            $mensaje=$usuario->pass;
            return view('admin.formulario_por_fechas',compact('usuario','datos','titulo','mensaje'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function BuscarPorFechas(Request $request){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $titulo="Estracto de Pagos por Fechas";
            $mensaje=$usuario->pass;
            $inicio=$request->inicio;
            $fin=$request->fin;
            $inicio=date('y-m-d',strtotime($inicio));
            $fin=date('y-m-d',strtotime($fin));
            $inicio=str_replace('-','',$inicio);
            $fin=str_replace('-','',$fin);

            $uri= array('inicio' =>$inicio,'fin'=>$fin,'moneda'=>$request->moneda);

            $extracto=DB::table('view_extracto')->where('fech','>=',$inicio)->where('fech','<=',$fin)->where('moneda',$request->moneda)->orderBy('fech','ASC')->get();
            return view('listas.lista_por_fechas',compact('usuario','datos','titulo','mensaje','extracto','fin','uri'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

     public function pagos_bob(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $titulo="Estracto de todos los Pagos";
            $mensaje=$usuario->pass;
            $extracto=DB::table('view_extracto')->where('moneda','BOB')->orderBy('fech','DESC')->get();
            $uri= array('inicio' =>'0','fin'=>'0','moneda'=>'BOB');
            return view('listas.lista_por_fechas',compact('usuario','datos','titulo','mensaje','extracto','uri'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function pagos_usd(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $titulo="Estracto de todos los Pagos";
            $mensaje=$usuario->pass;
            $extracto=DB::table('view_extracto')->where('moneda','USD')->orderBy('fech','DESC')->get();
            $uri= array('inicio' =>'0','fin'=>'0','moneda'=>'USD');
            return view('listas.lista_por_fechas',compact('usuario','datos','titulo','mensaje','extracto','uri'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function AddModulo(Request $request){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $registro=request()->except('_token');
            //return response()->json($registro);
            App\Modulos::create($registro);
            
            return redirect(route('perfil_curso',$request->id_curso));	
            //return redirect()->route('lista_curso')->with('info','Nota Final guardada con exito!!.');
        }
        else
            return redirect('/');
    }

    public function formulario_docente(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $titulo="Crear Docente"; 
            $mensaje=$usuario->pass;
            //return response()->json($datos);
            return view('admin.formulario_docente',compact('usuario','datos','titulo','mensaje'));
        }
        else
            return redirect('/');
    }

    public function lista_docente(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $lista=DB::table('usuarios')->join('personas','personas.id','=','usuarios.id_persona')->where('usuarios.tipo',4)->select('*','usuarios.id as id_usuario')->get();
            $titulo="Lista de Docentes";
            $mensaje=$usuario->pass;
            //return response()->json($lista);
            return view('listas.lista_docente',compact('usuario','datos','titulo','lista','mensaje'));
        }
        else
            return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio

    public function perfil_docente($id_usuario){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first(); // usuario administrador
            $perfil=DB::table('usuarios')->join('personas','personas.id','=','usuarios.id_persona')->where('usuarios.tipo',4)->select('*','usuarios.id as id_usuario')->where('usuarios.id',$id_usuario)->first();
            //return response()->json($perfil);
            $titulo='Perfil del Docente : '.$perfil->nombre;
            $mensaje=$usuario->pass;
            return view('admin.perfil_docente',compact('usuario','datos','titulo','perfil','mensaje'));
        }
        else
            return redirect('/');
    }

    public function listaModulo(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            
            $lista=DB::table('modulos')->join('cursos','modulos.id_curso','=','cursos.id')->where('id_docente',$usuario->id_persona)->orderBy('id_curso','DESC')->get();
            //return response()->json($lista);
            $titulo="Lista de Cursos";
            $mensaje=$usuario->pass;
            return view('listas.lista_mi_modulo',compact('usuario','datos','titulo','lista','mensaje'));
        }
        else
            return redirect('/');
    }

    public function lista_estudiantem($id_curso,$sigla){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $lista=DB::table('estudiantes')->join('personas','estudiantes.id_persona','=','personas.id')->join('modulos','modulos.id_curso','=','estudiantes.id_curso')->where('estudiantes.id_curso',$id_curso)->where('modulos.sigla',$sigla)->select('modulos.id','estudiantes.id_usuario','estudiantes.id_persona','estudiantes.estado','estudiantes.id_curso','estudiantes.habilitado','estudiantes.requisito','estudiantes.titulo','personas.ci','personas.nombre','personas.apellido','personas.correo','personas.celular','personas.foto','modulos.sigla','modulos.id_docente')
            ->orderBy('personas.apellido','ASC')->get();
            $titulo="Lista de Estudiantes";
            $mensaje=$usuario->pass;
            
            //return response()->json($lista);
            return view('listas.lista_estudiante_m',compact('usuario','datos','titulo','lista','mensaje'));
        }
        else
            return redirect('/');
    }

    public function lista_cursohistorial(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            
            $lista=DB::table('cursohistorial')->get();
            $titulo="Lista de Cursos";
            $mensaje=$usuario->pass;
            //return response()->json($lista);
            return view('listas.lista_cursohistorial',compact('usuario','datos','titulo','lista','mensaje'));
        }
        else
            return redirect('/');
    }

    public function curso_historial($id_curso){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $datos=App\Persona::where('id',$usuario->id_persona)->first();
            $curso=DB::table('cursohistorial')->where('id',$id_curso)->find($id_curso);
            $titulo="Curso ".$curso->codigo;
            $mensaje=$usuario->pass;
            $modulo=DB::table('modulohistorial')->join('docentehistorial','modulohistorial.id_docentehistorial','=','docentehistorial.id')->where('id_cursohistorial',$id_curso)
            ->select('modulohistorial.id','modulohistorial.id_cursohistorial','modulohistorial.sigla',
            'modulohistorial.modulo','docentehistorial.nombres','docentehistorial.apellidos','docentehistorial.tipodocente')->get();
           // return response()->json($modulo);
            return view('admin.curso_historial',compact('usuario','datos','titulo','mensaje','curso','modulo'));
        }
        else
            return redirect('/');
    }
}
