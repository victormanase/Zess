<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        @isset($title)
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @endisset
    </ol>
</nav>
