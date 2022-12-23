<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller_JenisData as Jenis;
use App\Http\Controllers\Controller_Kecamatan as Kecamatan;
use App\Http\Controllers\Controller_kelurahan as kelurahan;
use App\Http\Controllers\Controller_laporan as Laporan;
use App\Http\Controllers\PublicsController;

Route::prefix('admin')
->controller(ApiController::class)->group(function () {
    Route::post('login', 'authenticate');
    Route::post('register', 'register');
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', 'logout');
        Route::post('me', 'get_user');
    });
});

Route::prefix('user')
->controller(PublicsController::class)->group(function () {
    Route::post('login', 'authenticate');
    Route::post('register', 'register');
    Route::middleware('auth:user-api')->group(function () {
        Route::post('logout', 'logout');
        Route::post('me', 'get_user');
    });
});

Route::prefix('kecamatan')->controller(Kecamatan::class)->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::post('/', 'store');
        Route::put('update/{id}', 'update');
        Route::delete('/{id}', 'destroy');
        Route::get('admin/', 'index');
        Route::get('admin/{id}', 'show');
    });

    Route::middleware('auth:user-api')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });
});

Route::prefix('kelurahan')->controller(Kelurahan::class)->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::post('/', 'store');
        Route::put('update/{id}', 'update');
        Route::delete('/{id}', 'destroy');
        Route::get('admin/', 'index');
        Route::get('admin/{id}', 'show');
    });

    Route::middleware('auth:user-api')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });
});

Route::prefix('laporan')->controller(Laporan::class)->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::post('/', 'store');
        Route::put('update/{id}', 'update');
        Route::delete('/{id}', 'destroy');
        Route::get('admin/', 'index');
        Route::get('admin/{id}', 'show');
        Route::get('admin/filter/{keterangan}', 'filter');
    });

    Route::middleware('auth:user-api')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });
});

Route::prefix('jenis')->controller(Jenis::class)->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::post('/', 'store');
        Route::put('update/{id}', 'update');
        Route::delete('/{id}', 'destroy');
        Route::get('admin/', 'index');
        Route::get('admin/{id}', 'show');
    });

    Route::middleware('auth:user-api')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });
});

// Route::group(['middleware' => ['jwt.auth']], function () {
//     Route::get('logout', [ApiController::class, 'logout']);
//     Route::get('get_user', [ApiController::class, 'get_user']);

//     Route::get('kecamatan', [Kecamatan::class, 'index']);
//     Route::get('kecamatan/{id}', [Kecamatan::class, 'show']);
//     Route::post('kecamatan', [Kecamatan::class, 'store']);
//     Route::put('kecamatan/{id}', [Kecamatan::class, 'update']);
//     Route::delete('kecamatan/{id}', [Kecamatan::class, 'destroy']);

//     Route::get('kelurahan', [kelurahan::class, 'index']);
//     Route::get('kelurahan/{id}', [kelurahan::class, 'show']);
//     Route::post('kelurahan', [kelurahan::class, 'store']);
//     Route::put('kelurahan/{id}', [kelurahan::class, 'update']);
//     Route::delete('kelurahan/{id}', [kelurahan::class, 'destroy']);

//     Route::get('laporan', [laporan::class, 'index']);
//     Route::get('laporan/{id}', [laporan::class, 'show']);
//     Route::post('laporan', [laporan::class, 'store']);
//     Route::put('laporan/{id}', [laporan::class, 'update']);
//     Route::delete('laporan/{id}', [laporan::class, 'destroy']);

//     Route::get('jenis_data', [jenis_data::class, 'index']);
//     Route::get('jenis_data/{id}', [jenis_data::class, 'show']);
//     Route::post('jenis_data', [jenis_data::class, 'store']);
//     Route::put('jenis_data/{id}', [jenis_data::class, 'update']);
//     Route::delete('jenis_data/{id}', [jenis_data::class, 'destroy']);
// });
