@extends('layout')

@section('content')
<div class="container rounded bg-white mb-5">
    <div class="row">
        <form method="post" action="/products/" class="col-md-12 border-right">
            @csrf
            <div class="p-3 py-2">
                <div class="align-items-center mb-3">
                    <h4>Tworzenie nowego produktu</h4>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 mt-2">
                        <span class="labels">Nazwa produktu</span>
                        <input name="name" type="text" class="form-control">
                    </div>
                    <div class="col-6 col-md-3 mt-2">
                        <span class="labels">Marka produktu</span>
                        <select name="brand_id" id="brandSelect" class="form-control" style="width: 100%;"></select>
                    </div>
                    <div class="col-6 col-md-3 mt-2">
                        <span class="labels">Kategoria produktu</span>
                        <select name="category_id" id="prodCatSelect" class="form-control" style="width: 100%;"></select>
                    </div>
                    <div class="col-6 col-md-3 mt-2">
                        <span class="labels">Ilość</span>
                        <input name="quantity" type="text" class="form-control">
                    </div>
                    <div class="col-6 col-md-3 mt-2">
                        <span class="labels">Cena</span>
                        <input name="price" type="text" class="form-control">
                    </div>
                    <div class="col-6 col-md-3 mt-2">
                        <span class="labels">Jednostka</span>
                        <select name="unit" class="form-control">
                            @foreach(app('unitHelper')->getAllProductUnits() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-md-3 mt-2">
                        <span class="labels">Status</span>
                        <select name="status" class="form-control">
                            @foreach(app('statusHelper')->getAllProductStatuses() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mt-2">
                        <span class="labels">Opis produktu</span>
                        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="5" style="resize: none;"></textarea>
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" type="submit">Dodaj nowy produkt</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('#brandSelect').select2({
        ajax: {
            url: '{{ route('ajax.searchBrands') }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term
                };
            },
            processResults: function (data) {
                var options = data.brands.map(function (brand) {
                    return '<option value="' + brand.id + '">' + brand.name + '</option>';
                });

                $('#brandSelect').html(options.join(''));

                return {
                    results: data.brands.map(function (brand) {
                        return {
                            id: brand.id,
                            text: brand.name
                        };
                    })
                };
            },
            cache: true
        },
        minimumInputLength: 2,
        placeholder: 'Wybierz markę',
        allowClear: true
    });
</script>
<script>
    $('#prodCatSelect').select2({
        ajax: {
            url: '{{ route('ajax.searchProductCategories') }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term
                };
            },
            processResults: function (data) {
                var options = data.productCategories.map(function (productCategory) {
                    return '<option value="' + productCategory.id + '">' + productCategory.name + '</option>';
                });

                $('#prodCatSelect').html(options.join(''));

                return {
                    results: data.productCategories.map(function (productCategory) {
                        return {
                            id: productCategory.id,
                            text: productCategory.name
                        };
                    })
                };
            },
            cache: true
        },
        minimumInputLength: 2,
        placeholder: 'Wybierz kategorię',
        allowClear: true
    });
</script>
@endsection
