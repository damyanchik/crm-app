<div class="container pt-5">
<form method="post" action="/authenticate" class="col-3 mx-auto">
    @csrf
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input name="email" type="email" id="form2Example1" class="form-control" />
        <label class="form-label" for="form2Example1">Wprowadź adres email</label>
    </div>
    @error('email')
    <div class="alert alert-warning" role="alert">
        {{ $message }}
    </div>
    @enderror

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input name="password" type="password" id="form2Example2" class="form-control" />
        <label class="form-label" for="form2Example2">Podaj hasło</label>
    </div>

    @error('password')
    <div class="alert alert-warning" role="alert">
        {{ $message }}
    </div>
    @enderror

    <!-- Submit button -->
    <div class="text-center">
        <button type="submit" class="btn btn-primary btn-block mb-4">Zaloguj się</button>
    </div>
</form>
</div>
