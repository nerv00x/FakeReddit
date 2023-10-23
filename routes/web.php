<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;



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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => 'true']);
Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Ejercicio 1 

Route::get('/ruta/{parametro?}', function ($parametro = null) {
    return "Parámetro opcional: " . $parametro;
});
Route::get('/ruta/{parametro?}', function ($parametro = 'ValorPorDefecto') {
    return "Parámetro opcional con valor por defecto: " . $parametro;
});

Route::post('/ruta-post', function () {
    return "Ruta POST sin protección CSRF";
});

Route::match(['get', 'post'], '/ruta-get-post', function () {
    if (request()->isMethod('get')) {
        return "Esta es una solicitud GET";
    } elseif (request()->isMethod('post')) {
        return "Esta es una solicitud POST";
    }
});

Route::get('/ruta-numerica/{parametro}', function ($parametro) {
    if (is_numeric($parametro)) {
        return "El parámetro es numérico: " . $parametro;
    } else {
        return "El parámetro no es numérico";
    }
});

Route::get('/ruta-letras-numeros/{letras}/{numeros}', function ($letras, $numeros) {
    if (ctype_alpha($letras) && is_numeric($numeros)) {
        return "El primer parámetro es de letras y el segundo de números: " . $letras . " - " . $numeros;
    } else {
        return "Los parámetros no cumplen con los requisitos";
    }
});



//Ejercicio 2 
Route::get('/host', function () {
    $dbHost = env('DB_HOST');
    return "La dirección IP de la base de datos es: " . $dbHost;
});

Route::get('/timezone', function () {
    $timezone = config('app.timezone');
    return "La zona horaria configurada es: " . $timezone;
});


//Ejercicio 3
Route::view('/inicio', 'home');

Route::get('/fecha', function () {
    $dia = date('d');
    $mes = date('m');
    $ano = date('Y');
    return view('fecha', compact('dia', 'mes', 'ano'));
});



Route::get('community', [App\Http\Controllers\CommunityLinkController::class, 'index']);
Route::post('community', [App\Http\Controllers\CommunityLinkController::class, 'store'])->middleware('auth','verified' );
Route::get('community/{channel:slug}', [App\Http\Controllers\CommunityLinkController::class, 'index']);

Route::get('/consultas1', function () {
    $usuarios = DB::table('users')
        ->where('name', 'like', '%Fer%')
        ->get();


    return $usuarios;
});

Route::get('/consultas2', function () {
    $usuarios = DB::table('users')
        ->where([
            ['email', 'like', '%laravel%.com'],
        ])
        ->get();

    return $usuarios;
});


Route::get('/consultas3', function () {
    $usuarios = DB::table('users')
        ->where('email', 'like', '%laravel%')
        ->orWhere('email', 'like', '%com%')
        ->get();

    return $usuarios;
});

Route::get('/consultas4', function () {
    DB::table('users')->insert([
        'name' => 'insert usuarioa-',
        'email' => 'insert@gmaila.com',
        'password' => 'contraseñaa'
    ]);

    return 'Usuario insertado correctamente.';
});

Route::get('/consultas5', function () {
    DB::table('users')->insert([
        ['name' => 'Usuario 1', 'email' => 'usuario1@ejemplo.com', 'password' => 'contra'],
        ['name' => 'Usuario 2', 'email' => 'usuario2@ejemplo.com', 'password' => 'contra'],
    ]);

    return 'Dos usuarios insertados correctamente.';
});

Route::get('/consultas6', function () {
    $id = DB::table('users')->insertGetId([
        'name' => 'inserta id',
        'email' => 'insertiad@gmail.com',
        'password' => 'contra',

    ]);

    return 'Usuario insertado con ID: ' . $id;
}); 
Route::get('/consultas7', function () {
    $affected = DB::table('users')
        ->where('id', 2)
        ->update(['email' => 'updateemail@gmail.com']);

    return 'Registros actualizados: ' . $affected;
});


Route::get('/consultas8', function () {
    $deleted = DB::table('users')
        ->where('id', 3)
        ->delete();

    return 'Registros eliminados: '.$deleted;
});

