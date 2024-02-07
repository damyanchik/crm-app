<form method="post" action="{{ route('destroyProductPhoto', $product['id']) }}" class="text-center my-2">
    @csrf
    @method('PUT')
    <button class="btn btn-danger border px-3 p-0">
        <i class="fa fa-minus"></i>&nbsp;Usuń zdjęcie
    </button>
</form>
