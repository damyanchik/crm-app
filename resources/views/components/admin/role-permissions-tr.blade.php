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
            @if($role['name'] !== 'admin')
                <button class="btn delete-role-btn" type="button" data-bs-toggle="modal"
                        data-bs-target="#deleteRoleModal" data-role-id="{{ $role['id'] }}">
                    <i class="fa-solid fa-trash-can" style="font-size: 15px; color: #b01111;"></i>
                </button>
            @endif
        </td>
    </tr>
@endforeach
