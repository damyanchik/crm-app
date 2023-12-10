@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    @can('rolesPermissionsAdmin')
                        <form action="{{ route('changeRoleEmployee', $user['id']) }}" method="post">
                            @csrf
                            @method('PUT')
                            <select name="id" class="form-control" style="width: 100%;"
                                    onchange="$(this).closest('form').submit();">
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
                    <form method="post" action="{{ route('deleteAvatarEmployee', $user['id']) }}"
                          class="text-center mb-2">
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
                <form method="post" action="{{ route('updateEmployee', $user['id']) }}" class="d-flex"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="file" class="form-control" name="avatar">
            </div>
            <div class="col-md-6 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Edytuj dane użytkownika</h4>
                        <button type="button" class="btn btn-primary profile-button" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                            Zmień hasło
                        </button>
                    </div>
                    <x-employees.edit-employee-details :user="$user"/>
                    @include('partials.employees._employee-down-buttons')
                </div>
            </div>
            </form>
        </div>
    </div>
    @include('partials.employees._change-password-employee-modal')
@endsection
