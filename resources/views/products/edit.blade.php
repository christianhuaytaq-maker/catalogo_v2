@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Editar Producto: {{ $product->name }}</h1>

    @if(session('error'))
        <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Nombre:</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label>Descripción:</label>
            <textarea name="description" class="border p-2 w-full">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label>Precio:</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label>Stock:</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label>Categoría:</label>
            <select name="category" class="border p-2 w-full" required>
                <option value="Electrónica" {{ old('category', $product->category) == 'Electrónica' ? 'selected' : '' }}>Electrónica</option>
                <option value="Ropa" {{ old('category', $product->category) == 'Ropa' ? 'selected' : '' }}>Ropa</option>
            </select>
        </div>
        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Actualizar</button>
        <a href="{{ route('products.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Cancelar</a>
    </form>
@endsection
