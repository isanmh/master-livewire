<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        // return view('pages.category.index', [
        //     'categories' => $categories
        // ]);
        return view('pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255'
        ]);

        Category::create($request->all());
        session()->flash('message', 'Category created successfully');
        return redirect()->route('categories');
    }

    public function edit(Category $category)
    {
        return view('pages.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255'
        ]);

        $category->update($request->all());
        session()->flash('message', 'Category updated successfully');
        return redirect()->route('categories');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('message', 'Category deleted successfully');
        return redirect()->route('categories');
    }
}
