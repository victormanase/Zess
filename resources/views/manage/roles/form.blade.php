@extends('layout.master')

@section('content')
    @component('components.form', [
        'size' => 12,
        'url' => $isEditing ? route('manage.roles.update', $role->id) : route('manage.roles.store'),
        'title' => $isEditing ? 'Edit Role' : 'Create a Role',
        'method' => $isEditing ? 'PUT' : null,
        ])
        <div class="row">
            <div class="form-group col-md-6">
                <label for="exampleInputEmail2">Name</label>
                <div>
                    <input type="name" class="form-control" id="exampleInputEmail2" autocomplete="off"
                        placeholder="Role name.." name="name" required value="{{ $role->name ?? null }}">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputEmail2">Display Name</label>
                <div>
                    <input type="text" class="form-control" id="exampleInputEmail2" autocomplete="off"
                        placeholder="Role display name.." name="display_name" required value="{{ $role->display_name ?? null }}">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="">Description</label>
                <div>
                    <textarea name="description" id="" cols="30" rows="4"
                        class="form-control">{{ $role->description ?? null }}</textarea>
                </div>
            </div>
        </div>
    @endcomponent
@endsection
@include('components.inputmask')
