<?php

namespace App\Http\Controllers\Admin\Interaction;

use App\Http\Requests\OrderRequest;
use App\Models\Interaction\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.interaction.orders.index', compact('orders'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.interaction.orders.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $create = Order::create($validated);

        if ($create) {
            session()->flash('success', 'Заказ успешно создана');
            return redirect()->route('orders.index');
        }

        return abort(500);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('admin.interaction.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'total' => 'required'
        ]);

        $data = $request->all();

        $update = $order->update($data);

        if ($update) {
            session()->flash('success', 'Заказ успешно обновлена!');
            return redirect()->route('orders.index');
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
        $order = Order::find($id);

        $delete = $order->delete($id);

        if ($delete) {
            session()->flash('delete', 'Заказ успешно удалена!');
            return redirect()->route('orders.index');
        }

        return abort(500);
    }
}
