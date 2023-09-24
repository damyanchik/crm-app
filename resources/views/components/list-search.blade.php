<form method="get" class="input-group">
    <div id="search-autocomplete" class="form-outline">
        <input name="search" type="search" id="form1" class="form-control" value="{{ request()->input(['search']) }}"/>
    </div>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-search"></i>
    </button>
    <div>
        <select name="display" class="form-select" onchange="$(this).closest('form').submit();">
            <option value="30" {{ request()->input(['display']) == 30 ? 'selected' : '' }}>30</option>
            <option value="60" {{ request()->input(['display']) == 60 ? 'selected' : '' }}>60</option>
            <option value="120" {{ request()->input(['display']) == 120 ? 'selected' : '' }}>120</option>
        </select>
    </div>
</form>
<div class="mt-2 p-1 float-end">
    {{ $list->appends(['search' => request()->input('search'), 'display' => request()->input('display')])->links() }}
</div>
{{ $slot }}
<div class="mt-2 p-1 float-end">
    {{ $list->appends(['search' => request()->input('search'), 'display' => request()->input('display')])->links() }}
</div>
