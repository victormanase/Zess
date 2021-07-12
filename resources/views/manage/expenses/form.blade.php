@extends('layout.master')

@section('content')
    @component('components.form', [
        'size' => 12,
        'url' => $isEditing ? route('manage.expenses.update', $expense->id) : route('manage.expenses.store'),
        'title' => $isEditing ? 'Edit Expense' : 'Create a Expense',
        'method' => $isEditing ? 'PUT' : null,
        ])
        <div class="row">
            <div class="form-group col-md-4">
                <label for="exampleInputEmail2">Name</label>
                <div>
                    <input type="name" class="form-control" id="exampleInputEmail2" autocomplete="off"
                        placeholder="Expense name.." name="name" required value="{{ $expense->name ?? null }}">
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="exampleInputEmail2">Display Name</label>
                <div>
                    <input type="text" class="form-control" id="exampleInputEmail2" autocomplete="off"
                        placeholder="Expense display name.." name="display_name" required value="{{ $expense->display_name ?? null }}">
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="exampleInputEmail2">Amount</label>
                <div>
                    <input type="text" name="amount" class="form-control" autocomplete="off" data-inputmask="'alias': 'currency'"
                        value="{{ $service->amount ?? null }}" required>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="">Category</label>
                <select name="expense_category_id" id="" class="form-control">
                    @foreach ($expenseCategories as $expenseCategory)
                        <option value="{{$expenseCategory->id}}">{{$expenseCategory->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="">Description</label>
                <div>
                    <textarea name="description" id="" cols="30" rows="4"
                        class="form-control">{{ $expense->description ?? null }}</textarea>
                </div>
            </div>
        </div>
    @endcomponent
@endsection
@include('components.inputmask')
