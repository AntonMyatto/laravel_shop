<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QuestionRequest;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    public function index()
    {

        $questions = Question::all();

        return view('admin.questions.index', compact('questions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tests = Test::all()->pluck('name', 'id');

        return view('admin.questions.create', compact('tests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('img')) {
            $filePath = Storage::disk('public')->put('images/questions', request()->file('img'));
            $validated['img'] = $filePath;
        }

        $create = Question::create($validated);

        if ($create) {
            session()->flash('success', 'Вопрос успешно создан');
            return redirect()->route('questions.index');
        }

        return abort(500);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $tests = Test::all()->pluck('name', 'id');
        return view('admin.questions.edit', compact('question', 'tests'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question' => 'required',
            'test_id' => 'required',
            'answers' => 'required',
            'number_correct_answer' => 'required',
            'img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2548',
        ]);

        $data = $request->all();

        if ($request->hasFile('img')) {
            if (!Storage::url($question->img)) {
                Storage::disk('public')->delete($question->img);
            }

            $filePath = Storage::disk('public')->put('images/questions', request()->file('img'), 'public');
            $data['img'] = $filePath;
        }

        $update = $question->update($data);

        if ($update) {
            session()->flash('success', 'Вопрос успешно обновлен!');
            return redirect()->route('questions.index');
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
        $question = Question::find($id);

        $delete = $question->delete($id);

        if ($delete) {
            session()->flash('delete', 'Вопрос успешно удален!');
            return redirect()->route('questions.index');
        }

        return abort(500);
    }

}
