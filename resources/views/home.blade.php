@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Bem vindo! Aqui estão alguns números sobre o Marvin Quiz.</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <h1>{{ $questions }}</h1>
                            Total de Questões
                        </div>
                        <div class="col-md-3 text-center">
                            <h1>{{ $users }}</h1>
                            Usuários Registrados
                        </div>
                        <div class="col-md-3 text-center">
                            <h1>{{ $quizzes }}</h1>
                            Testes Realizados
                        </div>
                        <div class="col-md-3 text-center">
                            <h1>{{ number_format($average, 2) }} / 10</h1>
                            Pontuação Média
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('proof.user') }}" class="btn btn-success">Visualizar meus testes!</a>
        </div>
    </div>
@endsection
