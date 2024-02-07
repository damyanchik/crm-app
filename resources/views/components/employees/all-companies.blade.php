<div class="col-md-4">
    <div class="p-3 py-1 py-md-5">
        <div class="col-md-12">
            <label class="labels mb-2">Lista obsługiwanych firm</label>
            <div class="companyServe overflow-auto border border-2 p-2" style="height: 30rem">
                @foreach($clients as $client)
                    <div class="p-1 border m-1 company-link">
                        <a href="/clients/{{ $client['id'] }}" class="btn text-left">{{ $client['company'] }}</a>
                    </div>
                @endforeach
            </div>
            <input name="searchCompany" type="text" class="form-control mt-2 border-2" placeholder="Szukaj..." id="searchCompanyInput">
        </div>
    </div>
</div>
