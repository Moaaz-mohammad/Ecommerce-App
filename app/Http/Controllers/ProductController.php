<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|int',
            'stock' => 'required|string',
            'product_picture.*' => 'required|image|mimes:jpg,png',
        ]);

        $product =  Product::create($request->all());

        $images = $request->file('product_picture');

        foreach ($images as $value) {
            $image_name = time() + rand(0000,9999) . +2 . '.' . $value->extension();
            $value->move(public_path('storage/products/') , $image_name);
            $product->images()->create(['path' => $image_name]);
        }


        return redirect()->route('products.index')->with('success' , 'Product Added SSuccessfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('dashboard.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|int',
            'stock' => 'required|string',
            'product_images.*' => 'sometimes|required|image|mimes:png,jpg',
        ]);
        $product->update($request->all());

        if ($request->hasFile('product_picture')) {
            $images = $request->file('product_picture');

            foreach ($images as  $value) {
                $image_name = time() + rand(0000,9999) . '.' . $value->extension();
                $value->move(public_path('storage/products/') , $image_name);

                $product->images()->create(['path' => $image_name]);

            }

        }
        return redirect()->route('products.index')->with('success' , 'product update successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            Storage::delete('public/products/' . $image->path);
            $image->delete();
        }
        $product->delete();
        return redirect()->back()->with('success' , 'Product Deleted');
    }

    public function destroyOneImage(Image $image){
        Storage::delete('public/products/' . $image->path);
        Image::destroy($image->id);
        return redirect()->back()->with('success' , 'The sinrle Image deleted successfuly');
    }
}
