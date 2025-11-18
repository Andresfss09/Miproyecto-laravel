    <?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Api\ProductApiController;
    use App\Http\Controllers\Api\AuthApiController;
    use App\Http\Controllers\Api\ExternalProductController;

Route::get('external-products', [ExternalProductController::class, 'index']);


    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Aquí defines todas las rutas de tu API. Laravel automáticamente las
    | servirá bajo el prefijo "/api".
    |
    */

    // 🧩 RUTAS PÚBLICAS
    Route::get('/products', [ProductApiController::class, 'index']);
    Route::get('/products/{id}', [ProductApiController::class, 'show']);

    // 👤 AUTENTICACIÓN (Sanctum)
    Route::post('/register', [AuthApiController::class, 'register']);
    Route::post('/login', [AuthApiController::class, 'login']);

    // 🔐 RUTAS PROTEGIDAS (requieren token de autenticación)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/products', [ProductApiController::class, 'store']);
        Route::put('/products/{id}', [ProductApiController::class, 'update']);
        Route::delete('/products/{id}', [ProductApiController::class, 'destroy']);

        Route::get('/user', function (Request $request) {
            return response()->json([
                'status' => 'success',
                'data' => $request->user(),
            ]);
        });

        Route::post('/logout', [AuthApiController::class, 'logout']);
    });
