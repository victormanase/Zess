<div class="row">
    <div class="col-md-12">
        <div class="p-2 mb-4 mt-4 text-dark border-bottom">
            MEDICAL INFORMATION
        </div>
    </div>
    <div class="form-group col-md-4">
        <label for="">Case No:</label>
        <div>
            <input type="text" class="form-control" id="" name="case_no"
                value="{{ $consultation->case_no ?? (old('case_no') ?? null) }}">
        </div>
    </div>
    <div class="form-group col-md-4">
        <label for="">Policy No:</label>
        <div>
            <input type="text" class="form-control" id="" name="policy_no"
                value="{{ $consultation->policy_no ?? (old('policy_no') ?? null) }}">
        </div>
    </div>
    <div class="form-group col-md-4">
        <label for="">C/O:</label>
        <div>
            <input type="text" class="form-control" id="" name="c_o"
                value="{{ $consultation->c_o ?? (old('c_o') ?? null) }}">
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="">HX of presenting illness:</label>
        <div>
            <textarea class="form-control" id=""
                name="hx_of_presenting_illness">{{ $consultation->hx_of_presenting_illness ?? (old('hx_of_presenting_illness') ?? null) }}</textarea>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="">Past medical HX:</label>
        <div>
            <textarea class="form-control" id=""
                name="past_medical_hx">{{ $consultation->past_medical_hx ?? (old('past_medical_hx') ?? null) }}</textarea>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="">Any known allergies:</label>
        <div>
            <textarea class="form-control" id=""
                name="any_known_allergies">{{ $consultation->any_known_allergies ?? (old('any_known_allergies') ?? null) }}</textarea>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="">O/E:</label>
        <div>
            <textarea class="form-control" id=""
                name="o_e">{{ $consultation->o_e ?? (old('o_e') ?? null) }}</textarea>
        </div>
    </div>
    <div class="row col-md-12">
        <div class="form-group col-md-3">
            <label for="">BP:</label>
            <div class="input-group col-xs-12">
                <input type="text" class="form-control" name="bp"
                    value="{{ $consultation->bp ?? (old('bp') ?? null) }}">
                <span class="input-group-append">
                    <div class="bg-light text-dark p-1">
                        <p class="mt-1">mmHg</p>
                    </div>
                </span>
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="">RR:</label>
            <div class="input-group col-xs-12">
                <input type="text" class="form-control" name="rr"
                    value="{{ $consultation->rr ?? (old('rr') ?? null) }}">
                <span class="input-group-append">
                    <div class="bg-light text-dark p-1">
                        <p class="mt-1">beat/Min</p>
                    </div>
                </span>
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="">SPO2:</label>
            <div class="input-group col-xs-12">
                <input type="text" class="form-control" name="spo2"
                    value="{{ $consultation->spo2 ?? (old('spo2') ?? null) }}">
                <span class="input-group-append">
                    <div class="bg-light text-dark p-1">
                        <p class="mt-1">%</p>
                    </div>
                </span>
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="">PR:</label>
            <div class="input-group col-xs-12">
                <input type="text" class="form-control" name="pr"
                    value="{{ $consultation->pr ?? (old('pr') ?? null) }}">
                <span class="input-group-append">
                    <div class="bg-light text-dark p-1">
                        <p class="mt-1">beat/Min</p>
                    </div>
                </span>
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="">Temp:</label>
            <div class="input-group col-xs-12">
                <input type="text" class="form-control" name="temp"
                    value="{{ $consultation->temp ?? (old('temp') ?? null) }}">
                <span class="input-group-append">
                    <div class="bg-light text-dark p-1">
                        <p class="mt-1">ºC</p>
                    </div>
                </span>
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="">Height:</label>
            <div class="input-group col-xs-12">
                <input type="text" class="form-control" name="height"
                    value="{{ $consultation->height ?? (old('height') ?? null) }}">
                <span class="input-group-append">
                    <div class="bg-light text-dark p-1">
                        <p class="mt-1">cm</p>
                    </div>
                </span>
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="">Weight:</label>
            <div class="input-group col-xs-12">
                <input type="text" class="form-control" name="weight"
                    value="{{ $consultation->weight ?? (old('weight') ?? null) }}">
                <span class="input-group-append">
                    <div class="bg-light text-dark p-1">
                        <p class="mt-1">kg</p>
                    </div>
                </span>
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="">FBS/RBG:</label>
            <div class="input-group col-xs-12">
                <input type="text" class="form-control" name="fbs_rbg"
                    value="{{ $consultation->fbs_rbg ?? (old('fbs_rbg') ?? null) }}">
                <span class="input-group-append">
                    <div class="bg-light text-dark p-1">
                        <p class="mt-1">kg</p>
                    </div>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="">RS:</label>
        <div>
            <textarea class="form-control" id="" name="rs">{{ $consultation->rs ?? (old('rs') ?? null) }}</textarea>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="">CVS:</label>
        <div>
            <textarea class="form-control" id=""
                name="cvs">{{ $consultation->cvs ?? (old('cvs') ?? null) }}</textarea>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="">PA:</label>
        <div>
            <textarea class="form-control" id="" name="pa">{{ $consultation->pa ?? (old('pa') ?? null) }}</textarea>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="">CNS:</label>
        <div>
            <textarea class="form-control" id=""
                name="cns">{{ $consultation->cns ?? (old('cns') ?? null) }}</textarea>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="">Others:</label>
        <div>
            <textarea class="form-control" id=""
                name="others">{{ $consultation->others ?? (old('others') ?? null) }}</textarea>
        </div>
    </div>
    @include('components.multiline-input',[
        "label"=>"Investigations:",
        "name"=>"investigations",
        "data"=>$consultation->investigations_formatted?? [""]
    ])
    @include('components.multiline-input',[
        "label"=>"Plans:",
        "name"=>"plans",
        "data"=>$consultation->plans_formatted??[""]
    ])
    @include('components.multiline-input',[
        "label"=>"PD:",
        "name"=>"pds",
        "data"=>$consultation->pds_formatted??[""]
    ])
    <div class="form-group col-md-12">
        <label for="">Doctor's Advice:</label>
        <div>
            <textarea class="form-control" id=""
                name="doctors_advice">{{ $consultation->doctors_advice ?? (old('doctors_advice') ?? null) }}</textarea>
        </div>
    </div>
</div>
