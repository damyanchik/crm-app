@extends('layout')

@section('content')
    <h1>Role i uprawnienia</h1>
    <div class="rounded bg-white">
        <form method="post" action="/admin/roles" class="border-right">
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
    <form method="post" action="/admin/permissions">
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
            @foreach($roles as $role)
                <tr>
                    <td>
                        {{ $role['name'] }}
                    </td>
                    <td class="row">
                        @foreach($permissions as $permission)
                            <ul class="small col-6 col-md-3 list-group">
                                @foreach($permission as $names)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                               name="{{ $role['id'] }}[]" value="{{ $names['name'] }}"
                                                {{ in_array($names['name'], array_column($role->permissions->toArray(), 'name')) ? 'checked' : '' }}
                                        >
                                        <label class="custom-control-label" for="task1">
                                            {{ app('RolesPermissionsEnum')->getPolishName($names['name']) }}
                                        </label>
                                    </div>
                                @endforeach
                            </ul>
                        @endforeach
                    </td>
                    <td class="">
                        <button class="btn delete-role-btn" type="button" data-bs-toggle="modal" data-bs-target="#deleteRoleModal" data-role-id="{{ $role['id'] }}">
                            <i class="fa-solid fa-trash-can" style="font-size: 15px; color: #b01111;"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center mt-4 col-12">
            <button class="btn btn-primary profile-button" type="submit">Potwierdź zmiany</button>
        </div>
    </form>
    <!-- Modal Delete Role -->
    <div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-labelledby="deleteRoleModal" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="/admin/roles/" class="modal-content" id="deleteRoleForm">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRoleModal">Usuwanie roli</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>Czy chcesz usunąć rolę?</span>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Usuń</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.delete-role-btn').on('click', function() {
                let roleId = $(this).data('role-id');

                $('#deleteRoleForm').attr('action', '/admin/roles/' + roleId);

            });
        });
    </script>
@endsection
