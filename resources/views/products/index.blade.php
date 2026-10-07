@extends('layouts.app')

@section('title', 'Catálogo de Productos')

@section('content')
<div class="container">

    <h2 class="text-2xl font-bold mb-4">Catálogo de Productos</h2>

    {{-- Formulario de búsqueda --}}
    <form method="GET" action="{{ route('products.index') }}" class="flex gap-2 mb-4 flex-wrap">
        <input type="text" name="search" placeholder="Buscar por nombre..."
               value="{{ request('search') }}"
               class="border p-2 rounded w-64">
        <input type="text" name="category" placeholder="Filtrar por categoría..."
               value="{{ request('category') }}"
               class="border p-2 rounded w-64">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Buscar</button>
        <a href="{{ route('products.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Limpiar</a>
    </form>

    {{-- Botón NUEVO PRODUCTO --}}
    <div class="mb-4">
        <a href="{{ route('products.create') }}"
           style="background:#16a34a; color:white; padding:10px 18px; border-radius:8px; text-decoration:none; font-weight:bold;">
            + Nuevo Producto
        </a>
    </div>

    {{-- Tabla de productos --}}
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
            @forelse ($products as $product)
            <tr class="border-b text-center">
                <td class="p-2">{{ $product->id }}</td>
                <td class="p-2">{{ $product->name }}</td>

                {{-- 🔴 CAMBIO: muestra la categoría relacionada, con respaldo al texto --}}
                <td class="p-2">
                    {{ $product->categoryRelation->name ?? $product->category ?? '—' }}
                </td>

                <td class="p-2">S/ {{ number_format($product->price, 2) }}</td>
                <td class="p-2">{{ $product->stock }}</td>
                <td class="p-2 space-x-2">
                    <a href="{{ route('products.show', $product) }}" class="text-blue-600">Ver</a>
                    <a href="{{ route('products.edit', $product) }}" class="text-yellow-600">Editar</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline"
                          onsubmit="return confirm('¿Eliminar este producto?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-4 text-center text-gray-500">No hay productos registrados</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
