@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-lg mx-auto">
    <h2 class="text-2xl font-bold mb-4">Editar Producto</h2>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                   class="border p-2 rounded w-full" required>
        </div>

        <div class="mb-3">
            <label class="block">Descripción</label>
            <textarea name="description" class="border p-2 rounded w-full">{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- 🔴 CAMBIO: <select> con las categorías de la BD --}}
        <div class="mb-3">
            <label class="block">Categoría</label>
            <select name="category_id" class="border p-2 rounded w-full" required>
                <option value="">-- Selecciona una categoría --</option>
                @foreach (\App\Models\Category::all() as $cat)
                    <option value="{{ $cat->id }}"
                        {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="block">Precio</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                   class="border p-2 rounded w-full" required>
        </div>

        <div class="mb-3">
            <label class="block">Stock</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                   class="border p-2 rounded w-full" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
        <a href="{{ route('products.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Cancelar</a>
    </form>
</div>
@endsection
