@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <form method="post" action="{{ route('updateCompanyDetailsAdmin') }}" class="d-flex">
                @csrf
                @method('PUT')
                <div class="col-md-6 border-right">
                    <div class="p-3 py-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Dane firmy</h4>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Nazwa firmy</label>
                                <input name="company" type="text" class="form-control"
                                       value="{{ $companyDetails['company'] ?? null }}">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">NIP</label>
                                <input name="tax" type="text" class="form-control"
                                       value="{{ $companyDetails['tax'] ?? null }}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Email</label>
                                <input name="email" type="email" class="form-control"
                                       value="{{ $companyDetails['email'] ?? null }}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Numer telefonu</label>
                                <input name="phone" type="text" class="form-control"
                                       value="{{ $companyDetails['phone'] ?? null }}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Adres</label>
                                <input name="address" type="text" class="form-control"
                                       value="{{ $companyDetails['address'] ?? null }}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Kod pocztowy</label>
                                <input name="postal_code" type="text" class="form-control"
                                       value="{{ $companyDetails['postal_code'] ?? null }}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Miasto</label>
                                <input name="city" type="text" class="form-control"
                                       value="{{ $companyDetails['city'] ?? null }}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Województwo</label>
                                <input name="state" type="text" class="form-control"
                                       value="{{ $companyDetails['state'] ?? null }}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Kraj</label>
                                <input name="country" type="text" class="form-control"
                                       value="{{ $companyDetails['country'] ?? null }}">
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" type="submit">Zapisz</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
