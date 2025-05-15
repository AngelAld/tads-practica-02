<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Families;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all products from the database

        $families = Families::all();
        $categories = Categories::all();
        $products = Products::with('category')->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category->name ?? 'Sin categoría',
                'category_id' => $product->category_id,
                'description' => $product->description,
                'price' => $product->price,
                'family' => $product->family->name ?? 'Sin familia',
                'family_id' => $product->family_id,
            ];
        });

        // Return the view with the products data
        return view('products.index', compact('products', 'families', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'family_id' => 'required|exists:families,id',
        ]);

        // Create a new product
        Products::create($request->all());

        // Redirect to the products index with a success message
        return redirect()->route('products.index')->with('success', 'Producto creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'family_id' => 'required|exists:families,id',
        ]);

        // Find the product by ID and update it
        $product = Products::findOrFail($id);
        $product->update($request->all());

        // Redirect to the products index with a success message
        return redirect()->route('products.index')->with('success', 'Producto actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the product by ID and delete it
        $product = Products::findOrFail($id);
        $product->delete();

        // Redirect to the products index with a success message
        return redirect()->route('products.index')->with('success', 'Producto eliminado con éxito.');
    }
}
