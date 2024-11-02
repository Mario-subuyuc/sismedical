<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\HomeController;
use BotMan\BotMan\BotMan;

// Página principal
//Route::get('/', function () { return view('index'); });
Route::get('/', [App\Http\Controllers\WebController::class, 'index'])->name('index');

// Autenticación (login, registro, etc.)
Auth::routes();

//ruta para chatde bot
Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);


// Ruta para mostrar el formulario de verificación de 2FA
Route::get('2fa_verify', [LoginController::class, 'show2FAVerifyForm'])->name('2fa.verify');
// Ruta para manejar la verificación del código de 2FA
Route::post('2fa_verify', [HomeController::class, 'verify2FA'])->name('valido');
// Página de inicio para usuarios autenticados
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Ruta para cerrar sesión
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


// Ruta del dashboard del administrador
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware(['auth']);

// Ruta para admin/usuarios
Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index')->middleware(['auth', 'can:admin.usuarios.index']);
// Ruta para gestión de usuarios panel crear
Route::get('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.create')->middleware(['auth', 'can:admin.usuarios.create']);
// Ruta para gestión de envio de formulario crear
Route::post('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'store'])->name('admin.usuarios.store')->middleware(['auth', 'can:admin.usuarios.store']);
// Ruta para ver usuario por id
Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('admin.usuarios.show')->middleware(['auth', 'can:admin.usuarios.show']);
// Ruta para ver editar usuario
Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit')->middleware(['auth', 'can:admin.usuarios.edit']);
// Ruta para enviar la actualizacion de usuario
Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update')->middleware(['auth', 'can:admin.usuarios.update']);
// Ruta para ver eliminar usuario
Route::get('/admin/usuarios/{id}/confirm-delete', [App\Http\Controllers\UsuarioController::class, 'confirmDelete'])->name('admin.usuarios.confirmDelete')->middleware(['auth', 'can:admin.usuarios.confirmDelete']);
// Ruta para mandar la eliminacion
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware(['auth', 'can:admin.usuarios.destroy']);


//rutas admin/secretarias
Route::get('/admin/secretarias', [App\Http\Controllers\SecretariaController::class, 'index'])->name('admin.secretarias.index')->middleware(['auth', 'can:admin.secretarias.index']);
// Ruta para gestión de secretarias panel crear
Route::get('/admin/secretarias/create', [App\Http\Controllers\SecretariaController::class, 'create'])->name('admin.secretarias.create')->middleware(['auth', 'can:admin.secretarias.create']);
// Ruta para mandar informacion
Route::post('/admin/secretarias/create', [App\Http\Controllers\SecretariaController::class, 'store'])->name('admin.secretarias.store')->middleware(['auth', 'can:admin.secretarias.store']);
// Ruta para ver secretaria por id
Route::get('/admin/secretarias/{id}', [App\Http\Controllers\SecretariaController::class, 'show'])->name('admin.secretarias.show')->middleware(['auth', 'can:admin.secretarias.show']);
// Ruta para ver editar secre
Route::get('/admin/secretarias/{id}/edit', [App\Http\Controllers\SecretariaController::class, 'edit'])->name('admin.secretarias.edit')->middleware(['auth', 'can:admin.secretarias.edit']);
// Ruta para enviar la actualizacion de secre
Route::put('/admin/secretarias/{id}', [App\Http\Controllers\SecretariaController::class, 'update'])->name('admin.secretarias.update')->middleware(['auth', 'can:admin.secretarias.update']);
// Ruta para ver eliminar secre
Route::get('/admin/secretarias/{id}/confirm-delete', [App\Http\Controllers\SecretariaController::class, 'confirmDelete'])->name('admin.secretarias.confirmDelete')->middleware(['auth', 'can:admin.secretarias.confirmDelete']);
// Ruta para mandar la eliminacion
Route::delete('/admin/secretarias/{id}', [App\Http\Controllers\SecretariaController::class, 'destroy'])->name('admin.secretarias.destroy')->middleware(['auth', 'can:admin.secretarias.destroy']);

//rutas admin/pacientes
Route::get('/admin/pacientes', [App\Http\Controllers\PacienteController::class, 'index'])->name('admin.pacientes.index')->middleware(['auth', 'can:admin.pacientes.index']);
// Ruta para gestión de pacientes panel crear
Route::get('/admin/pacientes/create', [App\Http\Controllers\PacienteController::class, 'create'])->name('admin.pacientes.create')->middleware(['auth', 'can:admin.pacientes.create']);
// Ruta para mandar informacion
Route::post('/admin/pacientes/create', [App\Http\Controllers\PacienteController::class, 'store'])->name('admin.pacientes.store')->middleware(['auth', 'can:admin.pacientes.store']);
// Ruta para ver paciente por id
Route::get('/admin/pacientes/{id}', [App\Http\Controllers\PacienteController::class, 'show'])->name('admin.pacientes.show')->middleware(['auth', 'can:admin.pacientes.show']);
// Ruta para ver editar paciente
Route::get('/admin/pacientes/{id}/edit', [App\Http\Controllers\PacienteController::class, 'edit'])->name('admin.pacientes.edit')->middleware(['auth', 'can:admin.pacientes.edit']);
// Ruta para enviar la actualizacion de paciente
Route::put('/admin/pacientes/{id}', [App\Http\Controllers\PacienteController::class, 'update'])->name('admin.pacientes.update')->middleware(['auth', 'can:admin.pacientes.update']);
// Ruta para ver eliminar paciente
Route::get('/admin/pacientes/{id}/confirm-delete', [App\Http\Controllers\PacienteController::class, 'confirmDelete'])->name('admin.pacientes.confirmDelete')->middleware(['auth', 'can:admin.pacientes.confirmDelete']);
// Ruta para mandar la eliminacion
Route::delete('/admin/pacientes/{id}', [App\Http\Controllers\PacienteController::class, 'destroy'])->name('admin.pacientes.destroy')->middleware(['auth', 'can:admin.pacientes.destroy']);

//rutas admin/consultorios
Route::get('/admin/consultorios', [App\Http\Controllers\ConsultorioController::class, 'index'])->name('admin.consultorios.index')->middleware(['auth', 'can:admin.consultorios.index']);
// Ruta para gestión de consultorios panel crear
Route::get('/admin/consultorios/create', [App\Http\Controllers\ConsultorioController::class, 'create'])->name('admin.consultorios.create')->middleware(['auth', 'can:admin.consultorios.create']);
// Ruta para mandar informacion
Route::post('/admin/consultorios/create', [App\Http\Controllers\ConsultorioController::class, 'store'])->name('admin.consultorios.store')->middleware(['auth', 'can:admin.consultorios.store']);
// Ruta para ver consultorios por id
Route::get('/admin/consultorios/{id}', [App\Http\Controllers\ConsultorioController::class, 'show'])->name('admin.consultorios.show')->middleware(['auth', 'can:admin.consultorios.show']);
// Ruta para ver editar consultorios
Route::get('/admin/consultorios/{id}/edit', [App\Http\Controllers\ConsultorioController::class, 'edit'])->name('admin.consultorios.edit')->middleware(['auth', 'can:admin.consultorios.edit']);
// Ruta para enviar la actualizacion de consultorios
Route::put('/admin/consultorios/{id}', [App\Http\Controllers\ConsultorioController::class, 'update'])->name('admin.consultorios.update')->middleware(['auth', 'can:admin.consultorios.update']);
// Ruta para ver eliminar consultorios
Route::get('/admin/consultorios/{id}/confirm-delete', [App\Http\Controllers\ConsultorioController::class, 'confirmDelete'])->name('admin.consultorios.confirmDelete')->middleware(['auth', 'can:admin.consultorios.confirmDelete']);
// Ruta para mandar la eliminacion
Route::delete('/admin/consultorios/{id}', [App\Http\Controllers\ConsultorioController::class, 'destroy'])->name('admin.consultorios.destroy')->middleware(['auth', 'can:admin.consultorios.destroy']);


//rutas admin/doctores
Route::get('/admin/doctores', [App\Http\Controllers\DoctorController::class, 'index'])->name('admin.doctores.index')->middleware(['auth', 'can:admin.doctores.index']);
// Ruta para gestión de doctores panel crear
Route::get('/admin/doctores/create', [App\Http\Controllers\DoctorController::class, 'create'])->name('admin.doctores.create')->middleware(['auth', 'can:admin.doctores.create']);
// Ruta para mandar informacion
Route::post('/admin/doctores/create', [App\Http\Controllers\DoctorController::class, 'store'])->name('admin.doctores.store')->middleware(['auth', 'can:admin.doctores.store']);
// Ruta para ver doctores por id
Route::get('/admin/doctores/{id}', [App\Http\Controllers\DoctorController::class, 'show'])->name('admin.doctores.show')->middleware(['auth', 'can:admin.doctores.show']);
// Ruta para ver editar doctores
Route::get('/admin/doctores/{id}/edit', [App\Http\Controllers\DoctorController::class, 'edit'])->name('admin.doctores.edit')->middleware(['auth', 'can:admin.doctores.edit']);
// Ruta para enviar la actualizacion de doctores
Route::put('/admin/doctores/{id}', [App\Http\Controllers\DoctorController::class, 'update'])->name('admin.doctores.update')->middleware(['auth', 'can:admin.doctores.update']);
// Ruta para ver eliminar doctores
Route::get('/admin/doctores/{id}/confirm-delete', [App\Http\Controllers\DoctorController::class, 'confirmDelete'])->name('admin.doctores.confirmDelete')->middleware(['auth', 'can:admin.doctores.confirmDelete']);
// Ruta para mandar la eliminacion
Route::delete('/admin/doctores/{id}', [App\Http\Controllers\DoctorController::class, 'destroy'])->name('admin.doctores.destroy')->middleware(['auth', 'can:admin.doctores.destroy']);

//rutas admin/horarios
Route::get('/admin/horarios', [App\Http\Controllers\HorarioController::class, 'index'])->name('admin.horarios.index')->middleware(['auth', 'can:admin.horarios.index']);
// Ruta para gestión de pacientes panel crear
Route::get('/admin/horarios/create', [App\Http\Controllers\HorarioController::class, 'create'])->name('admin.horarios.create')->middleware(['auth', 'can:admin.horarios.create']);
// Ruta para mandar informacion
Route::post('/admin/horarios/create', [App\Http\Controllers\HorarioController::class, 'store'])->name('admin.horarios.store')->middleware(['auth', 'can:admin.horarios.store']);
// Ruta para ver horarios por id
Route::get('/admin/horarios/{id}', [App\Http\Controllers\HorarioController::class, 'show'])->name('admin.horarios.show')->middleware(['auth', 'can:admin.horarios.show']);
// Ruta para ver editar horarios
Route::get('/admin/horarios/{id}/edit', [App\Http\Controllers\HorarioController::class, 'edit'])->name('admin.horarios.edit')->middleware(['auth', 'can:admin.horarios.edit']);
// Ruta para enviar la actualizacion de horarios
Route::put('/admin/horarios/{id}', [App\Http\Controllers\HorarioController::class, 'update'])->name('admin.horarios.update')->middleware(['auth', 'can:admin.horarios.update']);
// Ruta para ver eliminar horarios
Route::get('/admin/horarios/{id}/confirm-delete', [App\Http\Controllers\HorarioController::class, 'confirmDelete'])->name('admin.horarios.confirmDelete')->middleware(['auth', 'can:admin.horarios.confirmDelete']);
// Ruta para mandar la eliminacion
Route::delete('/admin/horarios/{id}', [App\Http\Controllers\HorarioController::class, 'destroy'])->name('admin.horarios.destroy')->middleware(['auth', 'can:admin.horarios.destroy']);

// ajax
Route::get('/admin/horarios/consultorios/{id}', [App\Http\Controllers\HorarioController::class, 'cargar_datos_consultorios'])->name('admin.horarios.cargar_datos_consultorios')->middleware(['auth', 'can:admin.horarios.cargar_datos_consultorios']);

// ajax y rutas para usuarios
Route::get('/consultorios/{id}', [App\Http\Controllers\WebController::class, 'cargar_datos_consultorios'])->name('cargar_datos_consultorios')->middleware(['auth', 'can:cargar_datos_consultorios']);
Route::get('/cargar_reserva_doctores/{id}', [App\Http\Controllers\WebController::class, 'cargar_reserva_doctores'])->name('cargar_reserva_doctores')->middleware(['auth', 'can:cargar_reserva_doctores']);
Route::get('/admin/ver_reservas/{id}', [App\Http\Controllers\AdminController::class, 'ver_reservas'])->name('ver_reservas')->middleware(['auth', 'can:ver_reservas']);
Route::post('/admin/eventos/create', [App\Http\Controllers\EventController::class, 'store'])->name('admin.eventos.create')->middleware(['auth', 'can:admin.eventos.create']);
Route::delete('/admin/eventos/destroy/{id}', [App\Http\Controllers\EventController::class, 'destroy'])->name('admin.eventos.destroy')->middleware(['auth', 'can:admin.eventos.destroy']);
