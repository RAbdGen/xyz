<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(): Factory|View|Application
    {
        $tracks = Track::paginate(10);
        $categories = Category::withCount('tracks')->get(); // Récupère toutes les catégories avec le compte des pistes
        return view('app.categories.index', compact('categories'));
    }


    /**
     * Show the form for creating a new category.
     */
    public function create(): View|Factory|Application
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories',
        ]);

        Category::create([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('app.categories.index')->with('success', 'Category added successfully.');
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category): View|Factory|Application
    {
        // Récupère les pistes associées à cette catégorie
        $tracks = $category->tracks;

        return view('app.categories.show', compact('category', 'tracks'));
    }



    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category): View|Factory|Application
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $category->category_id,
        ]);

        $category->update([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('app.categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('app.categories.index')->with('success', 'Category deleted successfully.');
    }
}
