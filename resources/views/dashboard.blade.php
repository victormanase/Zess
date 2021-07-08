@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="card card-body">
    <div class="row">
        <div class="col-md-6 text-center border-right">
            <img src="{{asset('assets/images/placeholder-doc.png')}}" alt="">
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <div>
                <h5>Welcome to your dashboard!</h5>
                <p>Dashboard stats aren't generated yet, but be sure to contact us and tell us which stats you would like to see here!</p><br>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic culpa quis itaque consectetur labore minus, rerum exercitationem assumenda facere harum amet illo libero magnam earum, cumque quia accusamus iste porro.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush
