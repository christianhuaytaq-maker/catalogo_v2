@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Detalle del Producto</h1>

    <div class="bg-white p-6 rounded shadow">
        <p class="mb-2"><strong>ID:</strong> {{ $product->id }}</p>
        <p class="mb-2"><strong>Nombre:</strong> {{ $product->name }}</p>
        <p class="mb-2"><strong>Descripción:</strong> {{ $product->description }}</p>
        <p class="mb-2"><strong>Precio:</strong> S/ {{ number_format($product->price, 2) }}</p>
        <p class="mb-2"><strong>Stock:</strong> {{ $product->stock }}</p>
        <p class="mb-2"><strong>Categoría:</strong> {{ $product->category }}</p>
    </div>

    <a href="{{ route('products.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded inline-block mt-4">
        Volver
    </a>
@endsection
