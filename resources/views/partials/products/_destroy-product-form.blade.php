<form method="post" action="{{ route('destroyProduct', $product['id']) }}" class="float-end align-items-center">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger border px-3 p-1">
        <i class="fa fa-minus"></i>&nbsp;Usuń produkt
    </button>
</form>
