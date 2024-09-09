<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Psy\CodeCleaner\ReturnTypePass;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('dashboard.categories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'name' => 'required|string',
            'category_picture' => 'required|image|mimes:jpg,png',
        ]);

        $category = Category::create($request->all());

        $image = $request->file('category_picture');

        $image_name = time() . '.' . $image->extension();

        $image->move(public_path('storage/categories'), $image_name);
        
        $category->image()->create(['path' => $image_name]);

        return redirect()->route('categories.index')->with('success', 'Category created succssfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string',
            'category_picture' => 'sometimes|mimes:png,jpg',
        ]);

        $category->update($request->all());

        if ($request->hasFile('category_picture')) {
            Storage::delete('storage.categories' . $request->image->path);
            $category->image->delete();
            $image = $request->file('category_picture');
            $image_name = time() . '.' . $image->extension();
            $image->move(public_path('storage/categories/'), $image_name);
            $category->image()->create(['path' => $image_name]);
        }

        return redirect()->route('categories.index')->with('success', 'Category updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Storage::delete('public/categories/'.$category->image->path);
        $category->image->delete();
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfuly');
    }
}
