@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <div class="col-md-6 border-right">
                <div class="p-3 py-1 py-md-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Dane klienta</h4>
                    </div>
                    <x-client-detail :client="$client" />
                </div>
            </div>
            <x-clients.all-orders :orders="$client->order" />
        </div>
        @include('partials.clients._clients-down-buttons')
    </div>
    <script src="{{ asset('/js/clients/search_invoices.js') }}"></script>
@endsection
