@if(!empty($list))
<form method="get" class="my-2 mt-4 row" id="listManager" data-arrow="{{ asset('images/arrow.png') }}">
    <div class="col-6">
        <div class="input-group mb-3 pageSearch__input">
            <input type="text" name="search" class="form-control" placeholder="Wyszukaj..." value="{{ request()->input(['search']) }}">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <div class="col-6">
        <div class="input-group mb-3 pageSearch__input float-end" style="width: 7.5rem;">
            <label class="input-group-text">
                <i class="fa-solid fa-list-ol" style="color: #707070;"></i>
            </label>
            <select name="display" class="form-select" onchange="$(this).closest('form').submit();">
                <option value="15" {{ request()->input(['display']) == 15 ? 'selected' : '' }}>15</option>
                <option value="30" {{ request()->input(['display']) == 30 ? 'selected' : '' }}>30</option>
                <option value="60" {{ request()->input(['display']) == 60 ? 'selected' : '' }}>60</option>
                <option value="120" {{ request()->input(['display']) == 120 ? 'selected' : '' }}>120</option>
            </select>
        </div>
    </div>
    <input name="column" value="{{ request()->input(['column']) }}" readonly hidden>
    <input name="order" value="{{ request()->input(['order']) }}" onchange="$(this).closest('form').submit();" readonly hidden>
</form>
{{ $slot }}
<div class="mt-4 mb-5 p-1 d-flex justify-content-center">
    {{ $list->appends([
    'search' => request()->input('search'),
    'display' => request()->input('display'),
    'column' => request()->input('column'),
    'order' => request()->input('order')
    ])->onEachSide(2)->links() }}
</div>
<script src="{{ asset('/js/sort_search_list.js') }}"></script>
<script src="{{ asset('/js/table_breakpoint.js') }}"></script>
@else
    Brak danych do wyświetlenia.
@endif
