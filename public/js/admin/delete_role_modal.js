$(document).ready(function() {
    $('.delete-role-btn').on('click', function() {
        let roleId = $(this).data('role-id');

        $('#deleteRoleForm').attr('action', '/admin/roles/' + roleId);

    });
});
