<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.tags.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $create = Tag::create($validated);

        if ($create) {
            session()->flash('success', 'Тег успешно создан');
            return redirect()->route('tags.index');
        }

        return abort(500);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'title' => 'required',
            'sort' => 'required',
        ]);

        $data = $request->all();

        $update = $tag->update($data);

        if ($update) {
            session()->flash('success', 'Тег успешно обновлен!');
            return redirect()->route('tags.index');
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
        $tag = Tag::find($id);

        $delete = $tag->delete($id);

        if ($delete) {
            session()->flash('delete', 'Тег успешно удален!');
            return redirect()->route('tags.index');
        }

        return abort(500);
    }
}
