<main style="margin-top: 58px;">
    <div class="container p-4">
        <div id="content-background" class="p-4">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
        @yield('content')
        </div>
    </div>
</main>
