{{-- This uses alpine js
Documentation: https://alpinejs.dev/start-here --}}
<div class="form-group col-md-12" x-data='{rows: {{ json_encode($data) }}, currentKey: 1}''>
    <label for="">{{ $label }}</label>
    <template x-for='(row, index) in rows' :key='row.key'>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="input-group">
                    <input type="text" class="form-control" name="{{ $name }}[]" :value="row.content">
                    <span class="input-group-append">
                        <template x-if="index==0">
                            <button class="btn-primary btn"
                                x-on:click=" currentKey++; rows.push({ content:'', key:currentKey });"
                                type="button">Add
                                more</button>
                        </template>
                        <template x-if="index!=0">
                            <button class="btn-danger btn" type="button"
                                x-on:click="rows.splice(index,1)">Remove</button>
                        </template>
                    </span>
                </div>
            </div>
        </div>
    </template>
</div>
