<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuoteRequest;
use App\Models\Quote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::all();

        return view('admin.quotes.index', compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.quotes.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuoteRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $create = Quote::create($validated);

        if ($create) {
            session()->flash('success', 'Цитаты успешно создан');
            return redirect()->route('quotes.index');
        }

        return abort(500);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Quote $quote)
    {
        return view('admin.quotes.edit', compact('quote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quote $quote)
    {
        $request->validate([
            'text' => 'required',
            'author' => 'required',
        ]);

        $data = $request->all();

        $update = $quote->update($data);

        if ($update) {
            session()->flash('success', 'Цитаты успешно обновлен!');
            return redirect()->route('quotes.index');
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
        $quote = Quote::find($id);

        $delete = $quote->delete($id);

        if ($delete) {
            session()->flash('delete', 'Цитаты успешно удален!');
            return redirect()->route('quotes.index');
        }

        return abort(500);
    }
}
