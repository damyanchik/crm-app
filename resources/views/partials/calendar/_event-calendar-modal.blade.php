<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-block">
                    <p id="eventStart" class="m-0 small"></p>
                    <p id="eventEnd" class="m-0 small"></p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="eventTitle"></p>
                <p id="eventDescription"></p>
                <div class="d-flex float-end">
                    <a id="eventAuthorLink" class="text-decoration-none" target="_blank">
                        <i class="fa-solid fa-user me-1" style="color: #707070;"></i>
                    </a>
                    <p id="eventAuthor"></p>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <form id="eventDelete" method="post" action="" class="float-end align-items-center">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-secondary" data-bs-dismiss="modal">Usuń</button>
                </form>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Zamknij</button>
            </div>
        </div>
    </div>
</div>
