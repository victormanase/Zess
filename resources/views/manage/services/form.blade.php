@extends('layout.master')

@section('content')
    @component('components.form', [
        'size' => 12,
        'url' => $isEditing ? route('manage.services.update', $service->id) : route('manage.services.store'),
        'title' => $isEditing ? 'Edit Service' : 'Create a Service',
        'method' => $isEditing ? 'PUT' : null,
        ])
        <div class="row">
            <div class="form-group col-md-6">
                <label for="exampleInputEmail2">Name</label>
                <div>
                    <input type="name" class="form-control" id="exampleInputEmail2" autocomplete="off"
                        placeholder="Service name.." name="name" required value="{{ $service->name ?? null }}">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputEmail2">Price</label>
                <div>
                    <input type="text" name="price" class="form-control" autocomplete="off" data-inputmask="'alias': 'currency'"
                        value="{{ $service->price ?? null }}" required>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="">Description</label>
                <div>
                    <textarea name="description" id="" cols="30" rows="4"
                        class="form-control">{{ $service->description ?? null }}</textarea>
                </div>
            </div>
        </div>
    @endcomponent
@endsection
@include('components.inputmask')
