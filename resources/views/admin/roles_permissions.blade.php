@extends('layout')

@section('content')
    <h1>Role i uprawnienia</h1>
    <div class="rounded bg-white">
        <form method="post" action="{{ route('storeRoleAdmin') }}" class="border-right">
            @csrf
            <div class="py-2 row">
                <div class="col-12 col-md-10">
                    <span class="labels">Tworzenie nowej roli</span>
                    <input name="name" type="text" class="form-control">
                    @error('name')
                    <span class="flash-message__alert" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="text-center mt-4 col-12 col-md-2">
                    <button class="btn btn-primary profile-button" type="submit">Utwórz rolę</button>
                </div>
            </div>
        </form>
    </div>
    <form method="post" action="{{ route('storePermissionAdmin') }}">
        @csrf
        <table id="table-breakpoint" class="table align-middle mt-5 bg-white border">
            <thead class="bg-light">
                <tr>
                    <th>Rola</th>
                    <th>Uprawnienia</th>
                    <th style="width: 6rem">Akcje</th>
                </tr>
            </thead>
            <tbody>
                <x-admin.role-permissions-tr :roles="$roles" :permissions="$permissions"/>
            </tbody>
        </table>
        <div class="text-center mt-4 col-12">
            <button class="btn btn-primary profile-button" type="submit">Potwierdź zmiany</button>
        </div>
    </form>
    @include('partials.admin._destory-role-modal')
    <script src="{{ asset('/js/admin/delete_role_modal.js') }}"></script>
@endsection
