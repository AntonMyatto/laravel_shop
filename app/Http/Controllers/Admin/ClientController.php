<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function newstatus(Request $request, $id)
    {
        $newstatus = Client::find($id);
        if ($newstatus->is_premium == 1) {
            $newstatus->is_premium = 0;
        } else {
            $newstatus->is_premium = 1;
        }

        $newstatus->update();

        return redirect()->route('clients.index')
            ->with('success', 'Статус изменен');
    }
}
