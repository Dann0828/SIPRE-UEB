<?php

use App\Http\Controllers\OrdenadorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('hojavidaperiferico/pdf/{perifericosyauxiliares_id}', [App\Http\Controllers\HojavidaperifericoController::class, 'pdfperiferico'])->name('hojavidaperiferico.pdf');
    Route::get('ordenador/pdf1/{id}', [App\Http\Controllers\OrdenadorController::class, 'pdfsininfo'])->name('ordenador.pdf1');
    Route::get('ordenador/pdf2/{id}', [App\Http\Controllers\OrdenadorController::class, 'pdfprestamo'])->name('ordenador.pdf2');
    Route::get('ordenador/pdf3/{id}', [App\Http\Controllers\OrdenadorController::class, 'pdfmantenimiento'])->name('ordenador.pdf3');
    Route::get('ordenador/pdf4/{id}', [App\Http\Controllers\OrdenadorController::class, 'pdfconinfo'])->name('ordenador.pdf4');
    Route::get('perifericosyauxiliare/pdf1/{id}', [App\Http\Controllers\PerifericosyauxiliareController::class, 'pdfsininfo'])->name('perifericosyauxiliare.pdf1');
    Route::get('perifericosyauxiliare/pdf2/{id}', [App\Http\Controllers\PerifericosyauxiliareController::class, 'pdfprestamo'])->name('perifericosyauxiliare.pdf2');
    Route::get('perifericosyauxiliare/pdf3/{id}', [App\Http\Controllers\PerifericosyauxiliareController::class, 'pdfmantenimiento'])->name('perifericosyauxiliare.pdf3');
    Route::get('perifericosyauxiliare/pdf4/{id}', [App\Http\Controllers\PerifericosyauxiliareController::class, 'pdfconinfo'])->name('perifericosyauxiliare.pdf4');
    Route::get('mantenimientoordenador/buscarPorId', [App\Http\Controllers\MantenimientoOrdenadorController::class, 'buscarPorId'])->name('mantenimientoordenador.buscarPorId');
    Route::get('mantenimientoordenador/buscarPorUsuario', [App\Http\Controllers\MantenimientoOrdenadorController::class, 'buscarPorUsuario'])->name('mantenimientoordenador.buscarPorUsuario');
    Route::get('mantenimientoordenador/buscarPorEquipo', [App\Http\Controllers\MantenimientoOrdenadorController::class, 'buscarPorEquipo'])->name('mantenimientoordenador.buscarPorEquipo');
    Route::get('mantenimientoordenador/buscarPorTipoMantenimiento', [App\Http\Controllers\MantenimientoOrdenadorController::class, 'buscarPorTipoMantenimiento'])->name('mantenimientoordenador.buscarPorTipoMantenimiento');
    Route::get('mantenimientoordenador/buscarPorFecha', [App\Http\Controllers\MantenimientoOrdenadorController::class, 'buscarPorFecha'])->name('mantenimientoordenador.buscarPorFecha');
    Route::get('mantenimientoperiferico/buscarPorId', [App\Http\Controllers\MantenimientoperifericoController::class, 'buscarPorId'])->name('mantenimientoperiferico.buscarPorId');
    Route::get('mantenimientoperiferico/buscarPorUsuario', [App\Http\Controllers\MantenimientoperifericoController::class, 'buscarPorUsuario'])->name('mantenimientoperiferico.buscarPorUsuario');
    Route::get('mantenimientoperiferico/buscarPorEquipo', [App\Http\Controllers\MantenimientoperifericoController::class, 'buscarPorEquipo'])->name('mantenimientoperiferico.buscarPorEquipo');
    Route::get('mantenimientoperiferico/buscarPorTipoMantenimiento', [App\Http\Controllers\MantenimientoperifericoController::class, 'buscarPorTipoMantenimiento'])->name('mantenimientoperiferico.buscarPorTipoMantenimiento');
    Route::get('mantenimientoperiferico/buscarPorFecha', [App\Http\Controllers\MantenimientoperifericoController::class, 'buscarPorFecha'])->name('mantenimientoperiferico.buscarPorFecha');
    Route::get('ordenador/buscar', [App\Http\Controllers\OrdenadorController::class, 'buscar'])->name('ordenador.buscar');
    Route::get('prestamo/buscarPorId', [App\Http\Controllers\PrestamoController::class, 'buscarPorId'])->name('prestamo.buscarPorId');
    Route::get('prestamo/buscarPorUsuario', [App\Http\Controllers\PrestamoController::class, 'buscarPorUsuario'])->name('prestamo.buscarPorUsuario');
    Route::get('prestamo/buscarPorPersona', [App\Http\Controllers\PrestamoController::class, 'buscarPorPersona'])->name('prestamo.buscarPorPersona');
    Route::get('prestamo/buscarPorEquipo', [App\Http\Controllers\PrestamoController::class, 'buscarPorEquipo'])->name('prestamo.buscarPorEquipo');
    Route::get('prestamo/buscarPorFechaPrestamo', [App\Http\Controllers\PrestamoController::class, 'buscarPorFechaPrestamo'])->name('prestamo.buscarPorFechaPrestamo');
    Route::get('prestamo/buscarPorFechaEntrega', [App\Http\Controllers\PrestamoController::class, 'buscarPorFechaEntrega'])->name('prestamo.buscarPorFechaEntrega');
    Route::get('prestamo/buscarPorEstado', [App\Http\Controllers\PrestamoController::class, 'buscarPorEstado'])->name('prestamo.buscarPorEstado');
    Route::get('prestamo/buscarEstudianteEnAPI', [App\Http\Controllers\PrestamoController::class, 'buscarEstudianteEnAPI'])->name('prestamo.buscarEstudianteEnAPI');
    Route::get('prestamo/buscarDocenteEnAPI', [App\Http\Controllers\PrestamoController::class, 'buscarDocenteEnAPI'])->name('prestamo.buscarDocenteEnAPI');
    Route::get('prestamo/buscarAdministrativoEnAPI', [App\Http\Controllers\PrestamoController::class, 'buscarAdministrativoEnAPI'])->name('prestamo.buscarAdministrativoEnAPI');
    Route::get('prestamop/buscarPorId', [App\Http\Controllers\PrestamopController::class, 'buscarPorId'])->name('prestamop.buscarPorId');
    Route::get('prestamop/buscarPorUsuario', [App\Http\Controllers\PrestamopController::class, 'buscarPorUsuario'])->name('prestamop.buscarPorUsuario');
    Route::get('prestamop/buscarPorPersona', [App\Http\Controllers\PrestamopController::class, 'buscarPorPersona'])->name('prestamop.buscarPorPersona');
    Route::get('prestamop/buscarPorEquipo', [App\Http\Controllers\PrestamopController::class, 'buscarPorEquipo'])->name('prestamop.buscarPorEquipo');
    Route::get('prestamop/buscarPorFechaPrestamo', [App\Http\Controllers\PrestamopController::class, 'buscarPorFechaPrestamo'])->name('prestamop.buscarPorFechaPrestamo');
    Route::get('prestamop/buscarPorFechaEntrega', [App\Http\Controllers\PrestamopController::class, 'buscarPorFechaEntrega'])->name('prestamop.buscarPorFechaEntrega');
    Route::get('prestamop/buscarPorEstado', [App\Http\Controllers\PrestamopController::class, 'buscarPorEstado'])->name('prestamop.buscarPorEstado');
    Route::get('prestamop/buscarEstudianteEnAPI', [App\Http\Controllers\PrestamopController::class, 'buscarEstudianteEnAPI'])->name('prestamop.buscarEstudianteEnAPI');
    Route::get('prestamop/buscarDocenteEnAPI', [App\Http\Controllers\PrestamopController::class, 'buscarDocenteEnAPI'])->name('prestamop.buscarDocenteEnAPI');
    Route::get('prestamop/buscarAdministrativoEnAPI', [App\Http\Controllers\PrestamopController::class, 'buscarAdministrativoEnAPI'])->name('prestamop.buscarAdministrativoEnAPI');
    Route::get('perifericosyauxiliares/buscar', [App\Http\Controllers\PerifericosyauxiliareController::class, 'buscar'])->name('perifericosyauxiliares.buscar');
    Route::get('salon/buscarPorId', [App\Http\Controllers\SalonController::class, 'buscarPorId'])->name('salon.buscarPorId');
    Route::get('salon/buscarPorEdificio', [App\Http\Controllers\SalonController::class, 'buscarPorEdificio'])->name('salon.buscarPorEdificio');
    Route::get('salon/buscarPorTipoAula', [App\Http\Controllers\SalonController::class, 'buscarPorTipoAula'])->name('salon.buscarPorTipoAula');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('estadoComputador', App\Http\Controllers\EstadoComputadorController::class);
    Route::resource('localidad', App\Http\Controllers\LocalidadController::class);
    Route::resource('ordenador', App\Http\Controllers\OrdenadorController::class);
    Route::resource('procesador', App\Http\Controllers\ProcesadorController::class);
    Route::resource('rolComputador', App\Http\Controllers\RolComputadorController::class);
    Route::resource('sistemaOperativo', App\Http\Controllers\SistemaOperativoController::class);
    Route::resource('slotsRam', App\Http\Controllers\SlotsRamController::class);
    Route::resource('tipoAdquisicion', App\Http\Controllers\TipoAdquisicionController::class);
    Route::resource('tipoAsignacionLocalidad', App\Http\Controllers\TipoAsignacionLocalidadController::class);
    Route::resource('tipoComputador', App\Http\Controllers\TipoComputadorController::class);
    Route::resource('tipoDiscoDuro', App\Http\Controllers\TipoDiscoDuroController::class);
    Route::resource('tipoPantalla', App\Http\Controllers\TipoPantallaController::class);
    Route::resource('tipoRam', App\Http\Controllers\TipoRamController::class);
    Route::resource('tipoSoftwareComputador', App\Http\Controllers\TipoSoftwareComputadorController::class);
    Route::resource('excelimportar', App\Http\Controllers\ExcelimportarController::class);
    Route::resource('tipoaux', App\Http\Controllers\TipoauxController::class);
    Route::resource('tipomantenimiento', App\Http\Controllers\TipoMantenimientoController::class);
    Route::resource('tipocambio', App\Http\Controllers\TipoCambioController::class);
    Route::resource('perifericosyauxiliares', App\Http\Controllers\PerifericosyauxiliareController::class);
    Route::resource('excelimportarpa', App\Http\Controllers\ImportarexcelpaController::class);
    Route::resource('persona', App\Http\Controllers\PersonaController::class);
    Route::resource('rol', App\Http\Controllers\RolController::class);
    Route::resource('programa', App\Http\Controllers\ProgramaController::class);
    Route::resource('facultad', App\Http\Controllers\FacultadController::class); 
    Route::resource('prestamo', App\Http\Controllers\PrestamoController::class);
    Route::resource('prestamop', App\Http\Controllers\PrestamopController::class);
    Route::resource('mantenimiento', App\Http\Controllers\MantenimientoOrdenadorController::class);
    Route::resource('hojavida', App\Http\Controllers\HojavidaordenadorController::class);
    Route::resource('tipomantenimiento', App\Http\Controllers\TipoMantenimientoController::class);
    Route::resource('mantenimientoperiferico', App\Http\Controllers\MantenimientoperifericoController::class);
    Route::resource('mantenimientoordenador', App\Http\Controllers\MantenimientoOrdenadorController::class);
    Route::get('/matenimiento-ordenador/create2', 'App\Http\Controllers\MantenimientoOrdenadorController@create2')->name('matenimiento-ordenador.create2');
    Route::post('/guardar-mantenimiento', 'App\Http\Controllers\MantenimientoOrdenadorController@store2')->name('guardar-mantenimiento.store2');
    Route::resource('salon', App\Http\Controllers\SalonController::class);
    Route::resource('tipoaula', App\Http\Controllers\TipoaulaController::class);
    Route::resource('edificio', App\Http\Controllers\EdificioController::class);
    Route::resource('importarAulas', App\Http\Controllers\ImportarAulaController::class);
    Route::resource('tipoareaua', App\Http\Controllers\TipoareauaController::class);
    Route::resource('dependenciaua', App\Http\Controllers\DependenciauaController::class);
    Route::resource('excelua', App\Http\Controllers\ExceluaController::class);
    Route::post('/ExcelimportarController/agregarSalones', [App\Http\Controllers\ExcelimportarController::class, 'agregarSalones'])->name('agregar');
    Route::get('/ordenador/edit2/{id}', [App\Http\Controllers\OrdenadorController::class, 'edit2'])->name('edit2');
    Route::get('/ordenador/edit3/{id}', [App\Http\Controllers\OrdenadorController::class, 'edit3'])->name('edit3');
    Route::get('/ordenador/edit4/{id}', [App\Http\Controllers\OrdenadorController::class, 'edit4'])->name('edit4');
    Route::get('/ordenador/edit5/{id}', [App\Http\Controllers\OrdenadorController::class, 'edit5'])->name('edit5');
    Route::get('/ordenador/edit6/{id}', [App\Http\Controllers\OrdenadorController::class, 'edit6'])->name('edit6');
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::resource('excelfacultades', App\Http\Controllers\ImportarexcelFacultadeController::class);
    Route::resource('excelpersonas', App\Http\Controllers\ImportarexcelPersonaController::class);
    Route::get('graficos',[App\Http\Controllers\GraficasController::class, 'graficoOrdenadores']);
    Route::get('graficos1',[App\Http\Controllers\GraficasController::class, 'graficosPersonas']);
    Route::get('graficos2',[App\Http\Controllers\GraficasController::class, 'graficosPerifericos']);
    Route::get('graficos3',[App\Http\Controllers\GraficasController::class, 'graficosMantenimientosOrdenador']);
    Route::get('graficos4',[App\Http\Controllers\GraficasController::class, 'graficosMantenimientosPerifericos']);
    Route::get('graficos5',[App\Http\Controllers\GraficasController::class, 'prestamoPerifericos']);
    Route::get('graficos6',[App\Http\Controllers\GraficasController::class, 'prestamoOrdenadores']);
    
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');