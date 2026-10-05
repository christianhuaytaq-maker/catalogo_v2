<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductController extends Controller
{
    // Mostrar el catálogo con filtros y paginación
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('products.index', compact('products'));
    }

    // Guardar un producto nuevo (con transacciones, como pidió el profesor)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'category' => $request->category,
            ]);

            DB::commit();

            return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al crear el producto: ' . $e->getMessage());
        }
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('products.create');
    }

    // Mostrar un producto específico
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Mostrar formulario de edición
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Actualizar un producto (según el código que envió tu profesor)
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Producto actualizado.');
    }

    // Eliminar un producto (según el código que envió tu profesor)
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado.');
    }
}
