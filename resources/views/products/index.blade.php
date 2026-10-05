@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Catálogo de Productos</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="GET" action="{{ route('products.index') }}" class="flex gap-2 mb-4">
        <input type="text" name="search" placeholder="Buscar por nombre..."
               value="{{ request('search') }}"
               class="border p-2 rounded w-1/3">

        <input type="text" name="category" placeholder="Filtrar por categoría..."
               value="{{ request('category') }}"
               class="border p-2 rounded w-1/3">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Buscar</button>

        <a href="{{ route('products.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">
            Limpiar
        </a>
    </form>

    <a href="{{ route('products.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">
        + Nuevo Producto
    </a>

    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="p-2">ID</th>
                <th class="p-2">Nombre</th>
                <th class="p-2">Categoría</th>
                <th class="p-2">Precio</th>
                <th class="p-2">Stock</th>
                <th class="p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr class="border-b hover:bg-gray-100">
                    <td class="p-2">{{ $product->id }}</td>
                    <td class="p-2">{{ $product->name }}</td>
                    <td class="p-2">{{ $product->category }}</td>
                    <td class="p-2">S/ {{ number_format($product->price, 2) }}</td>
                    <td class="p-2">{{ $product->stock }}</td>
                    <td class="p-2">
                        <a href="{{ route('products.show', $product) }}"
                           class="text-blue-600 hover:underline">Ver</a>
                        <a href="{{ route('products.edit', $product) }}"
                           class="text-yellow-600 hover:underline ml-2">Editar</a>
                        <form action="{{ route('products.destroy', $product) }}"
                              method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Eliminar?')"
                                    class="text-red-600 hover:underline ml-2">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center p-4">No hay productos registrados</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endsection
