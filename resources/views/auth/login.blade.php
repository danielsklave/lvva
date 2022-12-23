@extends('layouts.register')

@section('body')
    <form class="form-signin" action="{{ route('login') }}" method="POST">
        @csrf

        <h1 class="h3 mb-3 font-weight-normal">Autorizācija</h1>

        <div class="form-group">
            <label for="inputEmail" class="sr-only">E-pasta adrese</label>
            <input type="email" name="email" class="form-control" placeholder="E-pasta adrese" required="">

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

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Atcerēties lietotāju
            </label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Autorizēties</button>

        <p class="mt-5"><a href="{{ route('register') }}">Reģistrēties</a></p>
    </form>
@endsection