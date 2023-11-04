<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('title', 'id');

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('img')) {
            $filePath = Storage::disk('public')->put('images/posts', request()->file('img'));
            $validated['img'] = $filePath;
        }

        $create = Post::create($validated);

        if ($create) {
            session()->flash('success', 'Пост успешно создан');
            return redirect()->route('posts.index');
        }

        return abort(500);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all()->pluck('title', 'id');

        return view('admin.posts.edit', compact('post','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'text' => 'required'
        ]);

        $data = $request->all();

        if ($request->hasFile('img')) {
            Storage::disk('public')->delete($post->img);
            $filePath = Storage::disk('public')->put('images/posts', request()->file('img'), 'public');
            $data['img'] = $filePath;
        }

        $update = $post->update($data);

        if ($update) {
            session()->flash('success', 'Пост успешно обновлен!');
            return redirect()->route('posts.index');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id): RedirectResponse
    {
        $post = Post::find($id);

        Storage::disk('public')->delete($post->img);

        $delete = $post->delete($id);

        if ($delete) {
            session()->flash('delete', 'Пост успешно удален!');
            return redirect()->route('posts.index');
        }

        return abort(500);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function newsort(Request $request, $id)
    {
        $product = Post::find($id);
        $product-> sort = $request-> sort;
        $product->update();

        return redirect()->route('posts.index')
            ->with('success','Сортировка изменена');
    }
}
