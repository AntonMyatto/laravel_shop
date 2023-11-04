<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClientsMessages;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientsMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cli_messages = ClientsMessages::all();

        $cli_read_messages = ClientsMessages::all()->where('visited', true);

        $cli_no_read_messages = ClientsMessages::all()->where('visited', false);

        $cli_messages_count = $cli_messages->count();

        $cli_read_messages_count = $cli_read_messages->count();

        $cli_no_read_messages_count = $cli_no_read_messages->count();

        return view('admin.clientmessages.index', compact('cli_messages', 'cli_messages_count', 'cli_no_read_messages_count', 'cli_no_read_messages', 'cli_read_messages', 'cli_read_messages_count'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = ClientsMessages::find($id);
        if ($data->visited < 1) {
            $data->visited++;
        }
        $data->update();

        $cli_read_messages = ClientsMessages::all()->where('visited', true);

        $cli_no_read_messages = ClientsMessages::all()->where('visited', false);

        $cli_read_messages_count = $cli_read_messages->count();

        $cli_no_read_messages_count = $cli_no_read_messages->count();

        $data->read = $cli_read_messages_count;

        $data->noread = $cli_no_read_messages_count;

        return response()->json(['data' => $data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function noread()
    {
        $cli_messages = ClientsMessages::all();

        $cli_read_messages = ClientsMessages::all()->where('visited', true);

        $cli_no_read_messages = ClientsMessages::all()->where('visited', false);

        $cli_messages_count = $cli_messages->count();

        $cli_read_messages_count = $cli_read_messages->count();

        $cli_no_read_messages_count = $cli_no_read_messages->count();

        return view('admin.clientmessages.noread', compact('cli_messages', 'cli_messages_count', 'cli_no_read_messages_count', 'cli_no_read_messages', 'cli_read_messages', 'cli_read_messages_count'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function read()
    {
        $cli_messages = ClientsMessages::all();

        $cli_read_messages = ClientsMessages::all()->where('visited', true);

        $cli_no_read_messages = ClientsMessages::all()->where('visited', false);

        $cli_messages_count = $cli_messages->count();

        $cli_read_messages_count = $cli_read_messages->count();

        $cli_no_read_messages_count = $cli_no_read_messages->count();

        return view('admin.clientmessages.read', compact('cli_messages', 'cli_messages_count', 'cli_no_read_messages_count', 'cli_no_read_messages', 'cli_read_messages', 'cli_read_messages_count'));
    }
}
