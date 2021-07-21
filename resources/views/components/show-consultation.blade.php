@extends('layout.master')

@section('content')
    @include('components.breadcrumb')
    <div class="card">
        <div class="card-header">
            Consultation on <strong>{{ $consultation->created_at->format('d/m/Y') }}</strong> for
            <strong>{{ $consultation->patient->name }}</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{asset("logo.png")}}" alt="" style="width: 200px">
                </div>
                <div class="col-md-6 text-right">
                    <p><strong>MEDICAL INFORMATION FORM</strong></p>
                    <p><strong>Date: {{ $consultation->created_at->format('d/m/Y') }}</strong></p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-3">
                    Case No: <strong>{{ $consultation->case_no }}</strong>
                </div>
                <div class="col-md-3">
                    Policy No: <strong>{{ $consultation->policy_no }}</strong>
                </div>
                <div class="col-md-3">
                    Time: <strong>{{ $consultation->created_at->format('HH:ii') }}</strong>
                </div>
                <div class="col-md-3 text-right">
                    Patient Name: <strong>{{ $consultation->patient->name }}</strong>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-3">
                    Patient Gender: <strong>{{ $consultation->patient->gender }}</strong>
                </div>
                <div class="col-md-3">
                    Patient DOB: <strong>{{ $consultation->patient->date_of_birth->format('d/m/Y') }}</strong>
                </div>
                <div class="col-md-3">
                    Patient Age: <strong>{{ $consultation->patient->age }}</strong>
                </div>
                <div class="col-md-3 text-right">
                    Patient Address: <strong>{{ $consultation->patient->address }}</strong>
                </div>
            </div>
            <hr>
            <div class="row mt-4">
                <div class="col-md-3 mt-4">
                    <p>C/O: <br> <strong>{!! $consultation->c_o !!}</strong></p>
                </div>
                <div class="col-md-3 mt-4">
                    <p>HX of presenting illness: <br> <strong>{!! $consultation->hx_of_presenting_illness !!}</strong></p>
                </div>
                <div class="col-md-3 mt-4">
                    <p>Past medical HX: <br> <strong>{!! $consultation->past_medical_hx !!}</strong></p>
                </div>
                <div class="col-md-3 mt-4">
                    <p>Any known allergies: <br> <strong>{!! $consultation->any_known_allergies !!}</strong></p>
                </div>
                <div class="col-md-3 mt-4">
                    <p>O/E: <br> <strong>{!! $consultation->o_e !!}</strong></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3 mt-4">
                    <p>BP: <strong>{{ $consultation->bp }} mmHg</strong></p>
                </div>
                <div class="col-md-3 mt-4">
                    <p>RR: <strong>{{ $consultation->rr }} beat/Min</strong></p>
                </div>
                <div class="col-md-3 mt-4">
                    <p>SPO2: <strong>{{ $consultation->spo2 }} %</strong></p>
                </div>
                <div class="col-md-3 mt-4">
                    <p>PR: <strong>{{ $consultation->bp }} beats/Min</strong></p>
                </div>
                <div class="col-md-3 mt-4">
                    <p>Temp: <strong>{{ $consultation->temp }} ºC</strong></p>
                </div>
                <div class="col-md-3 mt-4">
                    <p>Height: <strong>{{ $consultation->height }} cm</strong></p>
                </div>
                <div class="col-md-3 mt-4">
                    <p>Weight: <strong>{{ $consultation->weight }} kg</strong></p>
                </div>
                <div class="col-md-3 mt-4">
                    <p>FBS/RBG: <strong>{{ $consultation->fbs_rbg }} mmol/L</strong></p>
                </div>
            </div>
            <hr>
            <div class="row mt-4">
                <div class="col-md-3 mt-4">
                    <p>RS: <br> <strong>{!! $consultation->rs !!}</strong></p>
                </div>
                <div class="col-md-3 mt-4">
                    <p>CVS: <br> <strong>{!! $consultation->cvs !!}</strong></p>
                </div>
                <div class="col-md-3 mt-4">
                    <p>PA: <br> <strong>{!! $consultation->pa !!}</strong></p>
                </div>
                <div class="col-md-3 mt-4">
                    <p>CNS: <br> <strong>{!! $consultation->cns !!}</strong></p>
                </div>
                <div class="col-md-3 mt-4">
                    <p>Other: <br> <strong>{!! $consultation->others !!}</strong></p>
                </div>
            </div>
            <hr>
            <div class="row mt-4">
                <div class="col-md-3">
                    <label for="">Investigations:</label>
                    @foreach ($consultation->investigations as $investigation)
                        <p>{{ $loop->iteration }}. <strong> {{ $investigation->content }}</strong></p>
                    @endforeach
                </div>
                <div class="col-md-3">
                    <label for="">Plans:</label>
                    @foreach ($consultation->plans as $plan)
                        <p>{{ $loop->iteration }}. <strong> {{ $plan->content }}</strong></p>
                    @endforeach
                </div>
                <div class="col-md-3">
                    <label for="">PDS:</label>
                    @foreach ($consultation->pds as $pds)
                        <p>{{ $loop->iteration }}. <strong> {{ $pds->content }}</strong></p>
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="row mt-4">
                <div class="col-md-6">
                    <label for="">Doctor's Advice <br> <small>(indicate if pt. is fit to fly where applicable)</small></label>
                    <p> <strong>{{$consultation->doctors_advice}}</strong></p>
                </div>
                <div class="col-md-6">
                    <label for="">Doctor's name</label>
                    <p><strong>{{$consultation->doctor->name}}</strong></p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{url()->previous()}}" class="btn btn-light">Back</a>
        </div>
    </div>
@endsection
