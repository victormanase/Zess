@extends('layout.master')

@section('content')
    @include('components.breadcrumb')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            @isset($title)
                                <h6 class="card-title">{{ $title }}</h6>
                            @endisset
                        </div>
                        <div class="col-md-2 text-right">
                            @isset($create)
                                <a href="{{ $create }}" class="btn btn-primary">
                                    <i class="mdi mdi-plus"></i>
                                    Create</a>
                            @endisset
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                    <div class="table-responive">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-styles')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/datatables.min.css" />
@endpush

@push('plugin-scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    {{-- <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/datatables.min.js">
    </script> --}}
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
    {{-- <script src="{{ asset('assets/js/data-table.js') }}"></script> --}}
    {{ $dataTable->scripts() }}
@endpush
