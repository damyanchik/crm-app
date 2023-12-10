<div class="mt-5 text-center">
    @if(request()->routeIs('editProduct'))
        @can('updateUser')
        <button class="btn btn-primary profile-button" type="submit">Zapisz zmiany</button>
        @endcan
    @elseif(request()->routeIs('createProduct')))
        <button class="btn btn-primary profile-button" type="submit">Dodaj nowy produkt</button>
    @endif
    <a href="{{ route('products') }}" class="btn btn-primary profile-button" type="button">Powrót do listy</a>
</div>
