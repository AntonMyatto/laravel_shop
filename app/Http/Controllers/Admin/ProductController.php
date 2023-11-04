<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('title', 'id');

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($request->title, '-');
        if ($request->hasFile('img')) {
            $filePath = Storage::disk('public')->put('images/products', request()->file('img'));
            $validated['img'] = $filePath;
        }

        if ($request->hasFile('video')) {
            $filePath = Storage::disk('public')->put('video/products', request()->file('video'));
            $validated['video'] = $filePath;
        }

        $create = Product::create($validated);

        if ($create) {
            session()->flash('success', 'Товар успешно создан');
            return redirect()->route('products.index');
        }

        return abort(500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return RedirectResponse
     */

    public function show($slug)
    {
        if (is_numeric($slug)) {
            $product = Product::findOrFail($slug);

            return Redirect::to(route('admin.products.show', $product->slug), 301);
        }

        $product = Product::whereSlug($slug)->firstOrFail();

        return view('admin.products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $categories = Category::all()->pluck('title', 'id');
        $product = Product::whereSlug($slug)->firstOrFail();

        return view('admin.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'published' => 'required',
            'content' => 'required',
            'price' => 'required',
            'img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2548',
            'slug' => 'required'
        ]);

        $data = $request->all();

        $data ['slug'] = Str::slug($request->title, '-');

        if ($request->hasFile('img')) {
            if (!Storage::url($product->img)) {
                Storage::disk('public')->delete($product->img);
            }
            $filePath = Storage::disk('public')->put('images/products', request()->file('img'), 'public');
            $data['img'] = $filePath;
        }

        $update = $product->update($data);

        if ($update) {
            session()->flash('success', 'Товар успешно обновлен!');
            return redirect()->route('products.index');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id): RedirectResponse
    {
        $product = Product::find($id);

        Storage::disk('public')->delete($product->img);

        $delete = $product->delete($id);

        if ($delete) {
            session()->flash('delete', 'Товар успешно удален!');
            return redirect()->route('products.index');
        }

        return abort(500);
    }
}
