@extends('layout.master')

@section('content')
    @component('components.form', [
        'size' => 12,
        'url' => $isEditing ? route('manage.expense-categories.update', $expenseCategory->id) : route('manage.expense-categories.store'),
        'title' => $isEditing ? 'Edit Expense Category' : 'Create an Expense Category',
        'method' => $isEditing ? 'PUT' : null,
        ])
        <div class="row">
            <div class="form-group col-md-6">
                <label for="exampleInputEmail2">Name</label>
                <div>
                    <input type="name" class="form-control" id="exampleInputEmail2" autocomplete="off"
                        placeholder="Expense-category name.." name="name" required value="{{ $expenseCategory->name ?? null }}">
                </div>
            </div>
        </div>
    @endcomponent
@endsection
@include('components.inputmask')
