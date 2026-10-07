@extends('layouts.app')

@section('title', 'Ver Producto')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-lg mx-auto">
    <h2 class="text-2xl font-bold mb-4">Detalle del Producto</h2>

    <p><strong>ID:</strong> {{ $product->id }}</p>
    <p><strong>Nombre:</strong> {{ $product->name }}</p>
    <p><strong>Descripción:</strong> {{ $product->description }}</p>
    <p><strong>Categoría:</strong> {{ $product->category }}</p>
    <p><strong>Precio:</strong> S/ {{ number_format($product->price, 2) }}</p>
    <p><strong>Stock:</strong> {{ $product->stock }}</p>

    <a href="{{ route('products.index') }}"
       class="bg-gray-500 text-white px-4 py-2 rounded inline-block mt-4">
        Volver
    </a>
</div>
@endsection
