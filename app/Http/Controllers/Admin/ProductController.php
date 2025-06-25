<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.pages.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.pages.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'required|image',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created!');
    }
    public function edit(Product $product)
    {
        return view('admin.pages.products.edit', compact('product'));
    }
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted!');
    }


}
