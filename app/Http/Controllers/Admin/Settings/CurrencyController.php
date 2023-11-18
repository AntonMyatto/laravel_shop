<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Requests\CurrencyRequest;
use App\Models\Settings\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::all();
        return view('admin.settings.currencies.index', compact('currencies'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.settings.currencies.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $create = Currency::create($validated);

        if ($create) {
            session()->flash('success', 'Валюта успешно создана');
            return redirect()->route('currencies.index');
        }

        return abort(500);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        return view('admin.settings.currencies.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'exchange_rate' => 'required'
        ]);

        $data = $request->all();

        $update = $currency->update($data);

        if ($update) {
            session()->flash('success', 'Валюта успешно обновлена!');
            return redirect()->route('currencies.index');
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
        $currency = Currency::find($id);

        $delete = $currency->delete($id);

        if ($delete) {
            session()->flash('delete', 'Валюта успешно удалена!');
            return redirect()->route('currencies.index');
        }

        return abort(500);
    }
}
