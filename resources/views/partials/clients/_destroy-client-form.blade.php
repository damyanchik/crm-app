<form method="post" action="{{ route('destroyClient', $client->id) }}" class="float-end align-items-center">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger border px-3 p-1">
        <i class="fa fa-minus"></i>&nbsp;Usuń klienta
    </button>
</form>
