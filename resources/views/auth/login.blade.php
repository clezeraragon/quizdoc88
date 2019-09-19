@extends('layouts.auth')

@section('content')
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h1 class="text-center" style="color: black">QuizDoc88</h1>
      <h3 class="text-center" style="color: black">Bem vindo ao QuizDoc88!</h3>
      <br />
      <div class="card">
        
      <div class="card-body">
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> Houve problemas com a entrada:
              <br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form
            role="form"
            method="POST"
            action="{{ url('login') }}">
              <input type="hidden"
                name="_token"
                value="{{ csrf_token() }}">

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email"
                  class="form-control"
                  name="email"
                  id="email"
                  value="{{ old('email') }}">
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password"
                  class="form-control"
                  name="password"
                  id="password">

                  <div class="row">
                    <div class="col-6 text-left">
                      <input
                        type="checkbox"
                        name="remember"> Lembrar senha
                    </div>

                    <div class="col-6 text-right">
                      <a href="{{ route('auth.password.reset') }}">Recuperar senha</a>
                    </div>
                  </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-6 text-center">
                    <button type="submit" class="btn btn-primary w-100">
                      Login
                    </button>
                  </div>
                  <div class="col-md-6 text-center">
                    <a href="{{ route('auth.register') }}" class="btn btn-default w-100">
                      Register
                    </a>
                  </div>
                </div>
              </div>

              <hr />

              <div class="form-group">
                <div class="row">
                  <div class="col-md-4 text-center">
                    <a href="#" class="btn btn-white"><i class="fab fa-google"></i> Google </a>
                  </div>
                  <div class="col-md-4 text-center">
                    <a href="#" class="btn btn-white"><i class="fab fa-facebook"></i> Facebook </a>
                  </div>
                  <div class="col-md-4 text-center">
                    <a href="#" class="btn btn-white"><i class="fab fa-github"></i> GitHub </a>
                  </div>
                </div>
              </div>
          </form>
      </div>
      </div>
      <div class="text-center" style="color: black">Created by <a href="https://doc88.com.br">Doc88 Desenvolvimento</a></div>
      <div class="text-center" style="color: black;margin-left: -63px;">Powered by <a href="https://doc88.com.br">doc88.com.br</a></div>
    </div>
  </div>
@endsection
