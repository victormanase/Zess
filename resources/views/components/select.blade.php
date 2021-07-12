<select name="{{ $item_name }}" id="" class="form-control">
    @if (isset($emptyField))
        <option value="" selected>{{ $emptyField }}</option>
    @endif
    @foreach ($collection as $item)
        <option value="{{ $item->{'id'} }}"
            {{ isset($data) ? ($data->{$item_name} == $item->id ? 'selected' : null) : null ?? ((old($item_name) == $item->id ? 'selected' : null) ?? (isset($selected) ? ($selected == $item->id ? 'selected' : '') : '')) }}>
            {{ $item->$item_name_field }}</option>
    @endforeach
</select>
