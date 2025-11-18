<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>
                    <a href="{{ route('products.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded text-sm">
                       ← Volver
                    </a>
                </div>

                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-600">ID del Producto</h3>
                        <p class="text-gray-800">{{ $product->id }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-600">Nombre</h3>
                        <p class="text-gray-800">{{ $product->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-600">Descripción</h3>
                        <p class="text-gray-800">
                            {{ $product->description ?? 'Sin descripción.' }}
                        </p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-600">Precio</h3>
                        <p class="text-gray-800 font-semibold text-lg">
                            ${{ number_format($product->price, 2) }}
                        </p>
                    </div>

                    <div class="flex space-x-3 mt-6">
                        <a href="{{ route('products.edit', $product->id) }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded text-sm">
                           Editar
                        </a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" 
                              onsubmit="return confirm('¿Eliminar este producto?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
