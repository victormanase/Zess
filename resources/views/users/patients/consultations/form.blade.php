@extends('layout.master')

@section('content')
    @component('components.form', [
        'size' => 12,
        'url' => $isEditing
        ? route('users.users.patients.consultations.update', [
        'consultation' => $consultation->id,
        'patient' => $consultation->patient_id,
        ])
        : route('users.users.patients.consultations.store', $patient->id),
        'title' => $isEditing ? 'Edit Consultation' : 'Create a Consultation',
        'method' => $isEditing ? 'PUT' : null,
        ])
        <div class="row">

            <div class="form-group col-md-4">
                <label for="">Service</label>
                <div>
                    @include('components.select',[
                    "collection"=>$services,
                    "item_name"=>"service_id",
                    "item_name_field"=>"name",
                    "data"=>$consultation??null
                    ])
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="">Patient</label>
                <div>
                    @include('components.select',[
                    "collection"=>$patients,
                    "item_name"=>"patient_id",
                    "item_name_field"=>"name",
                    "selected"=>$patient->id
                    ])
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="">Doctor</label>
                <div>
                    @include('components.select',[
                    "collection"=>$doctors,
                    "item_name"=>"doctor_id",
                    "item_name_field"=>"name",
                    "data"=>$consultation??null,
                    "emptyField"=>"Select A Doctor"
                    ])
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="">Date</label>
                <div class="input-group date datepicker" id="datePickerExample">
                    <input type="text" name="date" class="form-control"
                        value="{{ (old('date') ?: null) ?? (isset($consultation) ? $consultation->date->format('Y-m-d') : null) }}"><span
                        class="input-group-addon"><i data-feather="calendar"></i></span>
                </div>
            </div>
            <div class="form-group col-md-8">
                <label for="">Description</label>
                <textarea name="description" id="" cols="30" rows="3"
                    class="form-control">{{ $consultation->description ?? old('description') }}</textarea>
            </div>
        </div>
    @endcomponent
@endsection
@include('components.inputmask')
@include('components.advanced-form')
