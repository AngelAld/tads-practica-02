<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Families;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::with('family')->get()->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'family' => $category->family->name ?? 'Sin familia',
                'family_id' => $category->family_id,
                'description' => $category->description,
            ];
        });
        $families = Families::all();

        return view('categories.index', compact('categories', 'families'));
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

        Log::info('Request data: ', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'family_id' => 'required',
        ]);

        try {
            Categories::create($request->all());
            return redirect()->route('categories.index')->with('success', 'Categoría creada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Error al crear la categoría: ' . $e->getMessage());
        }
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

        $category = Categories::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'family_id' => 'required',
        ]);

        $category->update($request->only('name', 'description', 'family_id'));

        return redirect()->route('categories.index')->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Log::info('Deleting category with ID: ' . $id);

        try {
            $category = Categories::findOrFail($id);
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Categoría eliminada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Ocurrió un error al intentar eliminar la categoría.' . $e->getMessage());
        }
    }
}
