<form method="get" class="my-2 mt-4 row">
    <div class="col-6">
        <div class="input-group mb-3 pageSearch__input">
            <input type="text" name="search" class="form-control" placeholder="Wyszukaj..." value="{{ request()->input(['search']) }}">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <div class="col-6">
        <div class="input-group mb-3 pageSearch__input float-end">
            <label class="input-group-text" for="inputGroupSelect02">Pozycji na stronie</label>
            <select name="display" class="form-select" onchange="$(this).closest('form').submit();">
                <option value="30" {{ request()->input(['display']) == 30 ? 'selected' : '' }}>30</option>
                <option value="60" {{ request()->input(['display']) == 60 ? 'selected' : '' }}>60</option>
                <option value="120" {{ request()->input(['display']) == 120 ? 'selected' : '' }}>120</option>
            </select>
        </div>
    </div>
</form>
{{ $slot }}
<div class="mt-4 mb-5 p-1 d-flex justify-content-center">
    {{ $list->appends(['search' => request()->input('search'), 'display' => request()->input('display')])->onEachSide(2)->links() }}
</div>
