@extends('layout')

@section('content')
<div class="container rounded bg-white mb-5">
    <div class="row">
        <form method="post" action="{{ route('storeProduct') }}" class="col-md-12 border-right" enctype="multipart/form-data">
            @csrf
            <div class="p-3 py-2">
                <div class="align-items-center mb-3">
                    <h4>Tworzenie nowego produktu</h4>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 mt-2">
                        <span class="labels">Nazwa produktu</span>
                        <input name="name" placeholder="Wpisz nazwę" type="text" class="form-control">
                        @error('name')
                        <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-6 col-md-3 mt-2">
                        <span class="labels">Marka produktu</span>
                        <select name="brand_id" id="brandSelect" class="form-control" style="width: 100%;"></select>
                    </div>
                    <div class="col-6 col-md-3 mt-2">
                        <span class="labels">Kategoria produktu</span>
                        <select name="category_id" id="prodCatSelect" class="form-control" style="width: 100%;"></select>
                    </div>

                    <div class="col-12 col-md-4 mt-2">
                        <span class="labels">Kod produktu</span>
                        <input name="code" placeholder="Wpisz kod" type="text" class="form-control">
                        @error('code')
                        <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-6 col-md-2 mt-2">
                        <span class="labels">Stan</span>
                        <input name="quantity" placeholder="Wpisz ilość" type="number" class="form-control">
                        @error('quantity')
                        <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-6 col-md-2 mt-2">
                        <span class="labels">Cena</span>
                        <input name="price" placeholder="Wpisz cenę" type="number" step="0.01" class="form-control">
                        @error('price')
                        <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-6 col-md-2 mt-2">
                        <span class="labels">Jednostka</span>
                        <select name="unit" class="form-control">
                            <option value="" disabled selected>Wybierz</option>
                            @foreach(app('ProductUnitEnum')->getAllUnits() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('unit')
                        <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-6 col-md-2 mt-2">
                        <span class="labels">Status</span>
                        <select name="status" class="form-control">
                            <option value="" disabled selected>Wybierz status</option>
                            @foreach(app('ProductStatusEnum')->getAllStatuses() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('status')
                        <span class="flash-message__alert" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-12 mt-2">
                        <span class="labels">Opis produktu</span>
                        <textarea name="description" class="form-control" rows="5" style="resize: none;"></textarea>
                    </div>
                    <div class="col-12 mt-2">
                        <span class="labels">Wybierz zdjęcie produktu</span>
                        <input type="file" class="form-control" name="photo" style="width: 18rem">
                        @error('photo')
                        <span class="flash-message__alert" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
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
    var ajaxSearchBrandLink = @json(route('ajax.searchBrands'));
    var ajaxSearchProductCategoriesLink = @json(route('ajax.searchProductCategories'));
</script>
<script src="{{ asset('/js/products/ajax_search_brands.js') }}"></script>
<script src="{{ asset('/js/products/ajax_search_product_categories.js') }}"></script>
@endsection
