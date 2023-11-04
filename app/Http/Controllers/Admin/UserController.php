<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.create',compact('roles'));
    }
    /**
     * Поместить только что созданный ресурс в хранилище.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $role_id = $request->roles;

        $validated['password'] = Hash::make($validated['password']);

        $create = User::create($validated);

        $create->roles()->attach($role_id);

        if ($create) {
            session()->flash('success', 'Пользователь успешно создан');
            return redirect()->route('users.index');
        }

        return abort(500);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('roles','user'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = $request->all();

        if(!empty($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }else{
            $data = Arr::except($data,array('password'));
        }

        $update = $user->update($data);

        $role_id = $request->roles;

        $user->roles()->sync($role_id);

        if ($update) {
            session()->flash('success', 'Пользователь успешно обновлен!');
            return redirect()->route('users.index');
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
        $user = User::find($id);

        $delete = $user->delete($id);

        if ($delete) {
            session()->flash('delete', 'Пользователь успешно удален!');
            return redirect()->route('users.index');
        }

        return abort(500);
    }
}
