<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all()->pluck('title', 'id');

        return view('admin.categories.create',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('img')) {
            $filePath = Storage::disk('public')->put('images/categories', request()->file('img'));
            $validated['img'] = $filePath;
        }

        $tags_id = $request->tags;

        $create = Category::create($validated);

        $create->tags()->attach($tags_id);

        if ($create) {
            session()->flash('success', 'Категория успешно создана');
            return redirect()->route('categories.index');
        }

        return abort(500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $tags = $category->tags;

        return view('admin.categories.show',compact('category','tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $tags = Tag::all();


        return view('admin.categories.edit', compact('category','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'published' => 'required',
            'type' => 'required'
        ]);

        $data = $request->all();

        if ($request->hasFile('img')) {
            Storage::disk('public')->delete($category->img);
            $filePath = Storage::disk('public')->put('images/categories', request()->file('img'), 'public');
            $data['img'] = $filePath;
        }

        $update = $category->update($data);

        $tags_id = $request->tags;

        $category->tags()->sync($tags_id);

        if ($update) {
            session()->flash('success', 'Категория успешно обновлена!');
            return redirect()->route('categories.index');
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
        $category = Category::find($id);

        Storage::disk('public')->delete($category->img);

        $delete = $category->delete($id);

        if ($delete) {
            session()->flash('delete', 'Категория успешно удалена!');
            return redirect()->route('categories.index');
        }

        return abort(500);
    }
}
