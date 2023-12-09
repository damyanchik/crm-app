@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        @can('rolesPermissionsAdmin')
                        <form action="/employees/{{ $user['id'] }}/change-role" method="post">
                            @csrf
                            @method('PUT')
                            <select name="id" class="form-control" style="width: 100%;" onchange="$(this).closest('form').submit();">
                                    <option value="">Brak przypisanej roli</option>
                                @if (!empty($roles))
                                    @foreach($roles as $role)
                                    <option value="{{ $role['id'] }}"
                                        {{ !empty($user->getRoleNames()[0]) && $user->getRoleNames()[0] == $role['name'] ? 'selected' : '' }}>
                                        {{ $role['name'] }}
                                    </option>
                                    @endforeach
                                @endif
                            </select>
                            <small style="color: grey">Wybierz rolę użytkownika</small>
                        </form>
                        @endcan
                        <img class="rounded-circle mt-5" width="150px"
                             @if(!empty($user['avatar']))
                                 src="{{ asset('storage/'.$user['avatar']) }}"
                             @else
                                 src="{{ asset('images/unknown.png') }}"
                             @endif
                        >
                    </div>
                    @if(!empty($user['avatar']))
                        <form method="post" action="/employees/{{$user['id']}}/delete-avatar" class="text-center mb-2">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-danger border px-3 p-0">
                                <i class="fa fa-minus"></i>&nbsp;Usuń zdjęcie
                            </button>
                        </form>
                    @endif
                    @error('avatar')
                    <span class="flash-message__alert" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                    <form method="post" action="/employees/{{$user['id']}}" class="d-flex" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <input type="file" class="form-control" name="avatar">
                </div>
                <div class="col-md-6 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Edytuj dane użytkownika</h4>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary profile-button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                Zmień hasło
                            </button>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Imię</label>
                                <input name="name" type="text" class="form-control" value="{{ $user['name'] }}">
                            </div>
                            <div class="col-md-6"><label class="labels">Nazwisko</label>
                                <input name="surname" type="text" class="form-control" value="{{ $user['surname'] }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 mt-2">
                                <label class="labels">Email</label>
                                <input name="email" type="email" class="form-control" value="{{ $user['email'] }}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Numer telefonu</label>
                                <input name="phone" type="text" class="form-control" value="{{ $user['phone'] }}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Adres zamieszkania</label>
                                <input name="address" type="text" class="form-control" value="{{ $user['address'] }}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Kod pocztowy</label>
                                <input name="postal_code" type="text" class="form-control"
                                       value="{{ $user['postal_code'] }}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Miasto</label>
                                <input name="city" type="text" class="form-control" value="{{ $user['city'] }}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Województwo</label>
                                <input name="state" type="text" class="form-control" value="{{ $user['state'] }}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Kraj</label>
                                <input name="country" type="text" class="form-control" value="{{ $user['country'] }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Pozycja</label>
                                <input name="position" type="text" class="form-control" value="{{ $user['position'] }}">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Dział</label>
                                <input name="department" type="text" class="form-control"
                                       value="{{ $user['department'] }}">
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" type="submit">Zapisz zmiany</button>
                            <a href="/employees" class="btn btn-primary profile-button" type="button">Powrót do
                                listy</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="/employees/{{$user['id']}}/change-pass" class="modal-content">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Zmień hasło</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="p-3">
                        <div class="col-md-12 mb-3">
                            <label class="labels">Podaj nowe hasło</label>
                            <input type="password" class="form-control" name="password" value="">
                            @error('password')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Powtórz nowe hasło</label>
                            <input type="password" class="form-control" name="password_confirmation" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Wyjdź</button>
                        <button class="btn btn-primary profile-button" type="submit">Ustaw</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @error('password')
    <script>
        $(document).ready(function() {
            $('#exampleModal').modal('show');
        });
    </script>
    @enderror

@endsection
