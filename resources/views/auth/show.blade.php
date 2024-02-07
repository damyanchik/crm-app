@extends('layout')

@section('content')
    <div class="container">
        <h4>{{ __('Potwierdź swój adres e-mail') }}</h4>
        <div class="row mt-4">
            <div class="col-12">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Nowe łącze weryfikacyjne zostało wysłane na Twój adres e-mail.') }}
                    </div>
                @endif

                {{ __('Zanim przejdziesz dalej, sprawdź swoją skrzynkę e-mail w poszukiwaniu łącza weryfikacyjnego.') }}
                {{ __('Jeśli nie otrzymałeś e-maila, kliknij na przycisk poniżej.') }}
                <form method="POST" action="{{ route('verification.resend') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-primary">Wyślij ponownie</button>
                </form>
            </div>
        </div>
    </div>
@endsection
