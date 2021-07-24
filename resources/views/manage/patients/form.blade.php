@extends('layout.master')

@section('content')
    @component('components.form', [
        'size' => 12,
        'url' => $isEditing ? route('manage.patients.update', $patient->id) : route('manage.patients.store'),
        'title' => $isEditing ? 'Edit Patient' : 'Create a Patient',
        'method' => $isEditing ? 'PUT' : null,
        ])
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">Name</label>
                <div>
                    <input type="text" class="form-control" id="" autocomplete="off" placeholder="Patient name.." name="name"
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
                <label for="">Reference no</label>
                <div>
                    <input type="text" name="reference_no" class="form-control" autocomplete="off"
                        value="{{ $patient->reference_no ?? (old('reference_no') ?? null) }}" placeholder="TZA-LDM ####-###">
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="">Hotel/Room</label>
                <div>
                    <input type="text" name="hotel_room" class="form-control" autocomplete="off"
                        value="{{ $patient->hotel_room ?? (old('hotel_room') ?? null) }}">
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="">Complaints</label>
                <div>
                    <input type="text" name="complaints" class="form-control" autocomplete="off"
                        value="{{ $patient->complaints ?? (old('complaints') ?? null) }}">
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="">Note</label>
                <div>
                    <input type="text" name="note" class="form-control" autocomplete="off"
                        value="{{ $patient->note ?? (old('note') ?? null) }}">
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="">Date of Birth</label>
                <div class="input-group date datepicker" id="datePickerExample">
                    <input type="text" name="date_of_birth" class="form-control"
                        value="{{ (old('date_of_birth') ?: null) ?? (isset($patient) ? $patient->date_of_birth->format('Y-m-d') : null) }}"><span
                        class="input-group-addon"><i data-feather="calendar"></i></span>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="">Gender</label>
                <div>
                    @include('components.select',[
                    "item_name"=>"gender",
                    "item_name_field"=>"name",
                    "collection"=>$genders,
                    "data"=>$patient??null
                    ])
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="">Address</label>
                <textarea name="address" id="" cols="30" rows="3"
                    class="form-control">{{ $patient->address ?? old("address") }}</textarea>
            </div>
            <div class="form-group col-md-4">
                <label for="">Client</label>
                <div>
                    @include('components.select',[
                    "item_name"=>"client_id",
                    "item_name_field"=>"name",
                    "collection"=>$systemClients,
                    "data"=>$patient??null,
                    "emptyField"=>"Select client"
                    ])
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="">Patient Type</label>
                <div>
                    @include('components.select',[
                    "item_name"=>"patient_type_id",
                    "item_name_field"=>"name",
                    "collection"=>$patientTypes,
                    "data"=>$patient??null,
                    "emptyField"=>"Select patient type"
                    ])
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4" style="display: none">
                <label for="">Password</label>
                <div>
                    <input type="hidden" name="password" class="form-control" autocomplete="off" value=""
                        {{ $isEditing ? '' : 'required' }}>
                    @if ($isEditing)
                        <small>(If you write a password here and edit, it will replace the old one, and will also need
                            confirmation, otherwise to retain old password leave the field empty)</small>
                    @endif
                </div>
            </div>
            <div class="form-group col-md-4" style="display: none">
                <label for="">Confirm Password</label>
                <div>
                    <input type="hidden" name="password_confirmation" class="form-control" autocomplete="off" value=""
                        {{ $isEditing ? '' : 'required' }}>
                </div>
            </div>
        </div>
    @endcomponent
@endsection
@include('components.inputmask')
@include('components.advanced-form')
