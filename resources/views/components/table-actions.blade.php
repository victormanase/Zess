@if (isset($view) || isset($delete) || isset($edit))
    <div class="action-button btn-group" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="mdi mdi-wrench"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            @isset($view)
                <a class="dropdown-item" href="{{ $view }}"><i class="mdi mdi-eye"></i> View</a>
            @endisset
            @isset($edit)
                <a class="dropdown-item" href="{{ $edit }}"><i class="mdi mdi-lead-pencil"></i> Edit</a>
            @endisset
            @isset($delete)
                <form action="{{ $delete }}" method="POST">
                    @method("delete")
                    @csrf
                    <button class="in-dropdown-button" onclick="return confirm('Are you sure you want to delete this? The action is not reversible!');">
                        <i class="mdi mdi-delete"></i> Delete
                    </button>
                </form>
            @endisset
        </div>
    </div>
    </div>
@endif
