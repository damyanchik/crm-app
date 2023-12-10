<div class="mt-5 text-center">
    @if(request()->routeIs('editEmployee'))
        <button class="btn btn-primary profile-button" type="submit">Zapisz zmiany</button>
    @endif
    <a href="{{ route('employees') }}" class="btn btn-primary profile-button" type="button">
        Powrót do listy
    </a>
</div>
