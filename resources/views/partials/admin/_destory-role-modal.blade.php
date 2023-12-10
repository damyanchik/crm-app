<div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-labelledby="deleteRoleModal" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="" class="modal-content" id="deleteRoleForm">
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
