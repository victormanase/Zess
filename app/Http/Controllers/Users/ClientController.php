<?php

namespace App\Http\Controllers\Users;

use App\DataTables\ClientDataTable;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Patient;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->initialise(
            "users/clients",
            "users.clients",
            [],
            [],
            Client::class
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClientDataTable $clientDataTable)
    {
        $title = "Manage Clients";
        $create = route("users.clients.create");
        return $clientDataTable->render("layout.table", compact("title", "create"));
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

        DB::transaction(function () use ($request) {
            $user = User::create($request->all());
            Client::create($request->merge([
                "user_id" => $user->id
            ])->all());
            $user->attachRole(Role::name("client"));
        });

        return redirect($this->root_url)->with("success", "Client added successfully");
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
        $this->client = Client::find($id);
        $this->user = $this->client->user;
        return $this->cView("form");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            "email" => ["required", "email", Rule::unique("users", "email")->ignore($client->user->id)],
            "password" => 'nullable',
            "password_confirmation" => "exclude_if:password,null|required|confirmed"
        ]);

        $client->update($request->all());
        $client->user->update($request->all());
        return redirect($this->root_url)->with("success", "Client modified successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        DB::transaction(function () use ($client) {
            $client->user->delete();
            $client->delete();
        });
        return redirect($this->root_url)->with("success", "Client deleted successfully");
    }
}
