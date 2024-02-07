<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="{{ route('changePasswordEmployee', $user['id']) }}" class="modal-content">
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
                <button class="btn btn-primary profile-button" type="submit">Ustaw</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Wyjdź</button>
            </div>
        </form>
    </div>
</div>


@error('password')
<script>
    $(document).ready(function() {
        $('#exampleModal').modal('show');
    });
</script>
@enderror
