<div id="main-navbar" class="container-fluid" style="height: 100vh;">
    <div class="row pt-md-5">
        <div class="col-6 col-md-6 mx-auto mt-md-5 mx-md-0">
            <div class="col-8 mx-auto mt-md-5 pt-md-2">
                <img src="{{ asset('/images/logo.png') }}" class="w-100 mt-5">
            </div>
        </div>
        <div class="col-md-6 py-md-4 mt-md-5">
            <form method="post" action="/authenticate" class="col-7 mx-auto mx-md-0 my-4 p-4 login">
                @csrf
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example1">Wprowadź adres email</label>
                    <input name="email" type="email" id="form2Example1" class="form-control"/>
                    @error('email')
                    <span class="flash-message__alert" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <!-- Password input -->
                <div class="form-outline mb-2">
                    <label class="form-label" for="form2Example2">Podaj hasło</label>
                    <input name="password" type="password" id="form2Example2" class="form-control"/>
                    @error('password')
                    <span class="flash-message__alert" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <!-- Submit button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block mt-3">Zaloguj się</button>
                </div>
            </form>
        </div>
    </div>
</div>
