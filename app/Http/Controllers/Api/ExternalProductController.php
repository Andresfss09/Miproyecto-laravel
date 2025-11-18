<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ExternalProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/external-products",
     *     summary="Obtener productos desde una API externa",
     *     tags={"Productos Externos"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de productos obtenida exitosamente"
     *     )
     * )
     */
    public function index()
    {
        $response = Http::get('https://fakestoreapi.com/products');

        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudieron obtener los productos externos'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Productos externos obtenidos exitosamente',
            'data' => $response->json()
        ]);
    }
}
