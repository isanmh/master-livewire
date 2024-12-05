<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        // $products = Product::all();
        // pagination
        $products = Product::latest()->paginate(2);
        return view('pages.product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $input = $request->validate([
            'name' => 'required|max:255|string',
            'price' => 'required|numeric',
            'description' => 'required|max:255|string',
            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            // $destinationPath = public_path('assets/images');
            // $image->move($destinationPath, $imageName);
            $image->storeAs('assets/images', $imageName, 'public');
            $input['image'] = $imageName;
        } else {
            $input['image'] = '';
        }

        Product::create($input);
        return redirect()->route('products.index')->with('message', 'Product successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $categories = Category::all();
        return view('pages.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('pages.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->validate([
            'name' => 'required|max:255|string',
            'price' => 'required|numeric',
            'description' => 'required|max:255|string',
            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // delete old image
            if ($product->image) {
                unlink(storage_path('app/public/assets/images/' . $product->image));
            }
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->storeAs('assets/images', $imageName, 'public');
            $input['image'] = $imageName;
        } else {
            $input['image'] = $product->image;
        }

        $product->update($input);
        return redirect()->route('products.index')->with('message', 'Product successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            unlink(storage_path('app/public/assets/images/' . $product->image));
        }
        $product->delete();
        return redirect()->route('products.index')->with('message', 'Product successfully deleted.');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $products = Product::where('name', 'like', "%" . $search . "%")->latest()->paginate(2);
        return view('pages.product.index', compact('products'));
    }

    // function format_uang($angka)
    // {
    //     return number_format($angka, 0, ',', '.');
    // }
}
