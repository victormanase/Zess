@extends('layout.master')

@section('content')
    @component('components.form', [
        'size' => 12,
        'url' => $isEditing ? route('users.clients.update', $client->id) : route('users.clients.store'),
        'title' => $isEditing ? 'Edit Client' : 'Create a Client',
        'method' => $isEditing ? 'PUT' : null,
        ])
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">Name</label>
                <div>
                    <input type="text" class="form-control" id="" autocomplete="off" placeholder="Client name.." name="name"
                        required value="{{ $user->name ?? (old('name') ?? null) }}">
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="exampleInputEmail2">Email</label>
                <div>
                    <input type="email" name="email" class="form-control" autocomplete="off"
                        value="{{ $user->email ?? (old('email') ?? null) }}" required>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="">Phone</label>
                <div>
                    <input type="number" name="phone" class="form-control" autocomplete="off"
                        value="{{ $user->phone ?? (old('phone') ?? null) }}" required>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="">Password</label>
                <div>
                    <input type="password" name="password" class="form-control" autocomplete="off" value=""
                        {{ $isEditing ? '' : 'required' }}>
                    @if ($isEditing)
                        <small>(If you write a password here and edit, it will replace the old one, and will also need
                            confirmation, otherwise to retain old password leave the field empty)</small>
                    @endif
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="">Confirm Password</label>
                <div>
                    <input type="password" name="password_confirmation" class="form-control" autocomplete="off" value=""
                        {{ $isEditing ? '' : 'required' }}>
                </div>
            </div>
        </div>
    @endcomponent
@endsection
@include('components.inputmask')
