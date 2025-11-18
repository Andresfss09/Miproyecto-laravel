<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Http;

class ProductApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Obtener todos los productos",
     *     tags={"Productos"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de productos obtenida exitosamente"
     *     )
     * )
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'status' => 'success',
            'data' => $products
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     summary="Obtener un producto por ID",
     *     tags={"Productos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del producto a buscar",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto encontrado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Producto no encontrado"
     *     )
     * )
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $product
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     summary="Crear un nuevo producto",
     *     tags={"Productos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","price"},
     *             @OA\Property(property="name", type="string", example="Camiseta Nike"),
     *             @OA\Property(property="description", type="string", example="Camiseta deportiva de algodón"),
     *             @OA\Property(property="price", type="number", format="float", example="59.99")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Producto creado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'status' => 'success',
            'data' => $product
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/products/{id}",
     *     summary="Actualizar un producto existente",
     *     tags={"Productos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del producto a actualizar",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Zapatos Adidas"),
     *             @OA\Property(property="description", type="string", example="Zapatos deportivos para correr"),
     *             @OA\Property(property="price", type="number", format="float", example="79.99")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto actualizado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Producto no encontrado"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric|min:0',
        ]);

        $product->update($validated);

        return response()->json([
            'status' => 'success',
            'data' => $product
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     summary="Eliminar un producto por ID",
     *     tags={"Productos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del producto a eliminar",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto eliminado correctamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Producto no encontrado"
     *     )
     * )
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Producto eliminado correctamente'], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/external-products",
     *     summary="Obtener productos desde una API externa",
     *     tags={"Productos Externos"},
     *     description="Consume datos desde la API pública fakestoreapi.com y los devuelve en formato JSON.",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de productos obtenida exitosamente desde la API externa",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Fjallraven - Foldsack No. 1 Backpack"),
     *                 @OA\Property(property="price", type="number", format="float", example=109.95),
     *                 @OA\Property(property="category", type="string", example="men's clothing"),
     *                 @OA\Property(property="description", type="string", example="Mochila perfecta para uso diario y actividades al aire libre"),
     *                 @OA\Property(property="image", type="string", example="https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al conectarse con la API externa"
     *     )
     * )
     */
    public function getExternalProducts()
    {
        try {
            $response = Http::get('https://fakestoreapi.com/products');

            if ($response->failed()) {
                return response()->json(['message' => 'Error al conectar con la API externa'], 500);
            }

            return response()->json([
                'status' => 'success',
                'data' => $response->json()
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrió un error: ' . $e->getMessage()], 500);
        }
    }
}
