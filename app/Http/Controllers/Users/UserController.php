<?php

namespace App\Http\Controllers\Users;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->initialise(
            "users",
            "users.manage",
            [],
            [],
            User::class
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $userDataTable)
    {
        $title = 'Manage Users';
        $create = route("users.create");
        return $userDataTable->render("layout.table", compact("title", "create"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->cView("form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed"
        ]);

        $user = User::create($request->all());
        $user->attachRole(Role::find($request->role_id));
        return redirect($this->root_url)->with("success", "User created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->isEditing = true;
        $this->user = User::find($id);
        return $this->cView("form");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "email" => ["required", "email", Rule::unique("users", "email")->ignore($id)],
            "password" => 'nullable',
            "password_confirmation" => "exclude_if:password,null|required|confirmed"
        ]);

        $user = User::find($id);
        $user->update($request->all());
        $user->syncRoles([Role::find($request->role_id)]);
        return redirect($this->root_url)->with("success", "User modified successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect($this->root_url)->with("success", "User deleted successfully");
    }
}
