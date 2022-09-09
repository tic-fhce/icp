<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','ControllerIcpRoute@index')->name('index');
Route::post('login','ControllerIcpAdmin@login')->name('login');
Route::get('a691jmmk69866ef77e7b8719892ac8d64efde/{m}','ControllerIcpAdmin@a691jmmk69866ef77e7b8719892ac8d64efde')->name('a691jmmk69866ef77e7b8719892ac8d64efde');
Route::get('formulario_registro','ControllerIcpRoute@formulario_registro')->name('formulario_registro');
Route::get('salir','ControllerIcpAdmin@salir')->name('salir');
Route::get('formularioUpdatePass','ControllerIcpAdmin@formularioUpdatePass')->name('formularioUpdatePass');
Route::post('UpdatePass','ControllerIcpUpdate@UpdatePass')->name('UpdatePass');




Route::post('AddEstudiante','ControllerIcpRoute@AddEstudiante')->name('AddEstudiante');
#MODULO USUARIO
Route::get('formulario_usuario','ControllerIcpAdmin@formulario_usuario')->name('formulario_usuario');
Route::post('AddUsuario','ControllerIcpAdd@AddUsuario')->name('AddUsuario');
Route::get('lista_usuario','ControllerIcpAdmin@lista_usuario')->name('lista_usuario');
Route::get('perfil/{id_usuario}/{id_curso}','ControllerIcpAdmin@perfil')->name('perfil');
Route::get('restPass/{id_usuario}','ControllerIcpUpdate@restPass')->name('restPass');
Route::get('perfil_usuario/{id_usuario}','ControllerIcpAdmin@perfil_usuario')->name('perfil_usuario');

Route::get('addnota/{id_usuario}/{id_curso}/{sigla}','ControllerIcpAdmin@addNota')->name('addnota');
Route::post('registraNota','ControllerIcpAdmin@registraNota')->name('registraNota');
Route::post('AddModulo','ControllerIcpAdmin@AddModulo')->name('AddModulo');
Route::get('formulario_docente','ControllerIcpAdmin@formulario_docente')->name('formulario_docente');
Route::post('AddDocente','ControllerIcpAdd@AddDocente')->name('AddDocente');
Route::get('lista_docente','ControllerIcpAdmin@lista_docente')->name('lista_docente');
Route::get('perfil_docente/{id_usuario}','ControllerIcpAdmin@perfil_docente')->name('perfil_docente');

#############################################
#MODULO REGIONES
Route::get('formulario_Region','ControllerIcpAdmin@formulario_Region')->name('formulario_Region');
Route::post('AddPais','ControllerIcpAdd@AddPais')->name('AddPais');
Route::get('formulario_Ciudad/{codigo}','ControllerIcpAdmin@formulario_Ciudad')->name('formulario_Ciudad');
Route::post('AddCiudad','ControllerIcpAdd@AddCiudad')->name('AddCiudad');
Route::get('listaRegion','ControllerIcpAdmin@listaRegion')->name('listaRegion');

#MODULO CURSO
Route::get('formulario_curso','ControllerIcpAdmin@formulario_curso')->name('formulario_curso');
Route::post('AddCurso','ControllerIcpAdd@AddCurso')->name('AddCurso');
Route::get('lista_curso','ControllerIcpAdmin@lista_curso')->name('lista_curso');
Route::get('perfil_curso/{id_curso}','ControllerIcpAdmin@perfil_curso')->name('perfil_curso');
Route::post('AddPlan','ControllerIcpAdd@AddPlan')->name('AddPlan');
Route::get('perfil_plan/{id_plan}','ControllerIcpAdmin@perfil_plan')->name('perfil_plan');
Route::post('AddCuota','ControllerIcpAdd@AddCuota')->name('AddCuota');
Route::post('AddParalelo','ControllerIcpAdd@AddParalelo')->name('AddParalelo');
Route::get('CerrarCurso/{id_curso}','ControllerIcpUpdate@CerrarCurso')->name('CerrarCurso');
Route::get('AbrirCurso/{id_curso}','ControllerIcpUpdate@AbrirCurso')->name('AbrirCurso');

Route::get('lista_cursohistorial','ControllerIcpAdmin@lista_cursohistorial')->name('lista_cursohistorial');
Route::get('curso_historial/{id_curso}','ControllerIcpAdmin@curso_historial')->name('curso_historial');

#MODULO ESTUDIANTE
Route::get('lista_estudiante/{id_curso}','ControllerIcpAdmin@lista_estudiante')->name('lista_estudiante');
Route::get('oferta/{id_matricula}','ControllerIcpAdmin@oferta')->name('oferta');
Route::get('perfil_curso_oferta/{id_curso}','ControllerIcpAdmin@perfil_curso_oferta')->name('perfil_curso_oferta');
Route::post('AddEstudianteCurso','ControllerIcpAdd@AddEstudianteCurso')->name('AddEstudianteCurso');
Route::get('estado','ControllerIcpAdmin@estado')->name('estado');
Route::get('estadocurso/{id_curso}','ControllerIcpAdmin@estadocurso')->name('estadocurso');
Route::get('micurso','ControllerIcpAdmin@micurso')->name('micurso');
Route::get('CrearPlan/{id_plan}/{id_curso}','ControllerIcpAdd@CrearPlan')->name('CrearPlan');
Route::get('DetallePago/{id_pago}','ControllerIcpAdmin@DetallePago')->name('DetallePago');
Route::post('check','ControllerIcpAdmin@check')->name('check');
Route::get('payment/{estado}/{id_transaction}/{reference}/{data4}/{data7}/{data15}/{data87}/{payer}/{uuid}/{auth_code}','ControllerIcpUpdate@payment')->name('payment');
Route::get('Recibo/{id_pago}','ControllerIcpPdf@Recibo')->name('Recibo');
Route::get('Extracto/{id_usuario}/{id_curso}','ControllerIcpPdf@Extracto')->name('Extracto');
Route::get('reciboafter/{id_pago}','ControllerIcpAdmin@reciboafter')->name('reciboafter');
Route::get('listaCursos','ControllerIcpAdmin@listaCursos')->name('listaCursos');
Route::get('Fincurso/{id_curso}','ControllerIcpUpdate@Fincurso')->name('Fincurso');
Route::get('estracto/{id_curso}','ControllerIcpAdmin@estracto')->name('estracto');

Route::get('listaModulo','ControllerIcpAdmin@listaModulo')->name('listaModulo');
Route::get('lista_estudiantem/{id_curso}/{sigla}','ControllerIcpAdmin@lista_estudiantem')->name('lista_estudiantem');
Route::get('notadocente/{id_curso}/{sigla}','ControllerIcpPdf@notadocente')->name('notadocente');
Route::get('notadocenteh/{id_curso}/{sigla}','ControllerIcpPdf@notadocenteh')->name('notadocenteh');

#MODULO PLAN

Route::get('CerrarPlan/{id_plan}','ControllerIcpUpdate@CerrarPlan')->name('CerrarPlan');
Route::get('AbrirPlan/{id_plan}','ControllerIcpUpdate@AbrirPlan')->name('AbrirPlan');

Route::get('HabilitarPago/{id_estudiante}','ControllerIcpUpdate@HabilitarPago')->name('HabilitarPago');
Route::get('CancelarPago/{id_estudiante}','ControllerIcpUpdate@CancelarPago')->name('CancelarPago');
Route::get('FormularioUpdatePago/{id_usuario}/{id_pago}','ControllerIcpAdmin@FormularioUpdatePago')->name('FormularioUpdatePago');
Route::post('UpdatePago','ControllerIcpUpdate@UpdatePago')->name('UpdatePago');
Route::post('AddPago','ControllerIcpAdd@AddPago')->name('AddPago');
Route::get('formulario_update_plan/{id_plan}','ControllerIcpAdmin@formulario_update_plan')->name('formulario_update_plan');
Route::post('UpdatePlan','ControllerIcpUpdate@UpdatePlan')->name('UpdatePlan');
Route::get('formulario_update_cuota/{id_cuota}','ControllerIcpAdmin@formulario_update_cuota')->name('formulario_update_cuota');
Route::post('UpdateCuota','ControllerIcpUpdate@UpdateCuota')->name('UpdateCuota');


#MODULO REPORTES
Route::get('formulario_por_fechas','ControllerIcpAdmin@formulario_por_fechas')->name('formulario_por_fechas');
Route::post('BuscarPorFechas','ControllerIcpAdmin@BuscarPorFechas')->name('BuscarPorFechas');
Route::get('pagos_bob','ControllerIcpAdmin@pagos_bob')->name('pagos_bob');
Route::get('pagos_usd','ControllerIcpAdmin@pagos_usd')->name('pagos_usd');
Route::get('reporte/{inicio}/{fin}/{moneda}','ControllerIcpPdf@reporte')->name('reporte');
Route::get('exportexcel/{inicio}/{fin}/{moneda}','ControllerIcpExcel@exportexcel')->name('exportexcel');




