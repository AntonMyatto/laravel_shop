<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TestRequest;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Test::all();

        return view('admin.tests.index', compact('tests'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Category::all()->pluck('title', 'id');

        return view('admin.tests.create', compact('courses'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $create = Test::create($validated);

        if ($create) {
            session()->flash('success', 'Тест успешно создан');
            return redirect()->route('tests.index');
        }

        return abort(500);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        $courses = Category::all()->pluck('title', 'id');
        return view('admin.tests.edit', compact('test','courses'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'course_id' => 'required',
            'published' => 'required',
        ]);

        $data = $request->all();

        $update = $test->update($data);

        if ($update) {
            session()->flash('success', 'Тест успешно обновлен!');
            return redirect()->route('tests.index');
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
        $test = Test::find($id);

        $delete = $test->delete($id);

        if ($delete) {
            session()->flash('delete', 'Тест успешно удален!');
            return redirect()->route('tests.index');
        }

        return abort(500);
    }
}
