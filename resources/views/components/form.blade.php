@include('components.breadcrumb')
<div class="row">
    <div class="col-md-{{ $size ?? '12' }} grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @isset($title)
                    <h6 class="card-title">{{ $title }}</h6>
                @endisset
                <form class="forms-sample" action="{{ $url }}" method="POST" enctype="multipart/form-data">
                    @isset($method)
                        @method($method)
                    @endisset
                    @csrf
                    {{ $slot }}
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{url()->previous()}}" class="btn btn-light">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
