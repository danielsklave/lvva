@extends('layouts.register')

@section('body')
    <form class="form-signin" action="{{ route('register') }}" method="POST">
        @csrf

        <h1 class="h3 mb-3 font-weight-normal">Reģistrācija</h1>

        <div class="form-group">
            <label for="inputName" class="sr-only">Lietotājvārds</label>
            <input type="text" name="name" class="form-control" placeholder="Lietotājvārds" value="{{ old('name') }}" required="">

            @error('name')
                <span class="text-red-600" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        
        <div class="form-group">
            <label for="inputEmail" class="sr-only">E-pasta adrese</label>
            <input type="email" name="email" class="form-control" placeholder="E-pasta adrese" value="{{ old('email') }}" required="">

            @error('email')
                <span class="text-red-600" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="inputPassword" class="sr-only">Parole</label>
            <input type="password" name="password" class="form-control" placeholder="Parole" required="">

            @error('password')
                <span class="text-red-600" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputPasswordConfirmation" class="sr-only">Parole atkārtoti</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Parole atkārtoti" required="">

            @error('password_confirmation')
                <span class="text-red-600" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Atcerēties lietotāju
            </label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Reģistrēties</button>

    
        <p class="mt-5 mb-3 text-muted">LVVA</p>
        <p>Jau esi reģistrējies? <a href="{{ route('login') }}">Autorizēties</a></p>
    </form>
@endsection