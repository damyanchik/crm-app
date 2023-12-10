<div class="mt-5 text-center">
    @if(request()->routeIs('editClient'))
        <button class="btn btn-primary profile-button" type="submit">Zapisz zmiany</button>
    @elseif(request()->routeIs('createClient'))
        <button class="btn btn-primary profile-button" type="submit">Utwórz klienta</button>
    @endif
    <a href="{{ route('clients') }}" class="btn btn-primary profile-button" type="button">
        Powrót do listy
    </a>
</div>
