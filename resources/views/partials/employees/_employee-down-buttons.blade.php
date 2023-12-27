<div class="mt-5 text-center">
    @if(request()->routeIs('editEmployee'))
        @if (auth()->check() && (auth()->user()->can('deleteAvatarUser') || request()->route('user')->id == auth()->id()))
        <button class="btn btn-primary profile-button" type="submit">Zapisz zmiany</button>
        @endif
    @endif
    <a href="{{ route('employees') }}" class="btn btn-primary profile-button" type="button">
        Powrót do listy
    </a>
</div>
