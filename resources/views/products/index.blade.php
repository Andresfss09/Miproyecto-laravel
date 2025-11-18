<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">Productos</h1>
                    <a href="{{ route('products.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                       + Nuevo Producto
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($products->isEmpty())
                    <div class="bg-blue-100 text-blue-800 p-3 rounded mb-4">
                        No hay productos registrados aún.
                    </div>
                @else
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left text-sm font-semibold text-gray-700">ID</th>
                                <th class="border px-4 py-2 text-left text-sm font-semibold text-gray-700">Nombre</th>
                                <th class="border px-4 py-2 text-left text-sm font-semibold text-gray-700">Precio</th>
                                <th class="border px-4 py-2 text-left text-sm font-semibold text-gray-700">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-2 text-sm text-gray-700">{{ $product->id }}</td>
                                    <td class="border px-4 py-2 text-sm text-gray-700">{{ $product->name }}</td>
                                    <td class="border px-4 py-2 text-sm text-gray-700">${{ number_format($product->price, 2) }}</td>
                                    <td class="border px-4 py-2 text-sm text-gray-700">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('products.show', $product->id) }}" 
                                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                               Ver
                                            </a>
                                            <a href="{{ route('products.edit', $product->id) }}" 
                                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                               Editar
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" 
                                                  onsubmit="return confirm('¿Eliminar este producto?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
