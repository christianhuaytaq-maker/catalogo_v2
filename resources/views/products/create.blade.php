@extends('layouts.app')

@section('title', 'Nuevo Producto')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-lg mx-auto">
    <h2 class="text-2xl font-bold mb-4">Nuevo Producto</h2>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="block font-semibold">Nombre</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="border p-2 rounded w-full" required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Descripción</label>
            <textarea name="description" class="border p-2 rounded w-full">{{ old('description') }}</textarea>
        </div>

        {{-- 🔴 CAMBIO: ahora es un <select> con las categorías de la BD --}}
        <div class="mb-3">
            <label class="block font-semibold">Categoría</label>
            <select name="category_id" class="border p-2 rounded w-full" required>
                <option value="">-- Selecciona una categoría --</option>
                @foreach (\App\Models\Category::all() as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Precio</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                   class="border p-2 rounded w-full" required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Stock</label>
            <input type="number" name="stock" value="{{ old('stock') }}"
                   class="border p-2 rounded w-full" required>
        </div>

        <button type="submit"
                style="background:#16a34a; color:white; padding:10px 18px; border-radius:8px; font-weight:bold; border:none; cursor:pointer;">
            Guardar
        </button>

        <a href="{{ route('products.index') }}"
           style="background:#9ca3af; color:white; padding:10px 18px; border-radius:8px; text-decoration:none;">
            Cancelar
        </a>
    </form>
</div>
@endsection
