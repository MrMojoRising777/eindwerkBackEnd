@extends('layouts.app')
  @section('content')
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Gebruikersprofiel</div>

            <div class="card-body">
              @if(session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
              @endif

              <!-- update username -->
              <form method="POST" action="{{ route('profile.update.username') }}">
                @csrf
                @method('PUT')

                <div class="form-group row">
                  <label for="username" class="col-md-4 col-form-label text-md-right">Gebruikersnaam</label>

                  <div class="col-md-8">
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autofocus>

                    @error('username')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">Wijzig gebruikersnaam</button>
                  </div>
                </div>
              </form>

              <hr>

              <!-- update password -->
              <form method="POST" action="{{ route('profile.update.password') }}">
                @csrf
                @method('PUT')

                <div class="form-group row">
                  <label for="password" class="col-md-4 col-form-label text-md-right">Wachtwoord</label>

                  <div class="col-md-8">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                  <div class="col-md-8">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">Wijzig wachtwoord</button>
                  </div>
                </div>
              </form>

              <hr>

              <form method="POST" action="{{ route('profile.delete') }}">
                @csrf
                @method('DELETE')

                <div class="form-group row mb-0">
                  <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your account?')">Verwijder account</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endsection