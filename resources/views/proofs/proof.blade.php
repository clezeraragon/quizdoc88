@extends('layouts.app')

@section('content')

    <div class="container-fluid ">
        <h3 class="card-header text-center">Meus Exames</h3><br>
        <div class="card-group" style="padding: 1rem;margin-left: 5rem;">
            @if(!$proofs)
                <div class="card text-white bg-warning mb-3">
                    <h5 class="card-header">Alerta!!</h5>
                    <div class="card-body">
                        <p class="card-text">Sua prova ainda não está disponível, aguarde nosso contato!</p>
                    </div>
                </div>
            @endif
            @foreach($proofs as $proof)

                <div class="">
                    <div class="card border-success mb-3" style="max-width: 18rem;">
                        <div class="card-header"><h5 class="text-center">{{ucfirst($proof['title'])}}</h5></div>
                        <div class="card-body text-primary">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item text-dark">
                                    <h1 class="text-center text-success">{{$proof['total_topic']}}</h1>
                                    <h5 class="text-left">Tópicos Relacionados</h5>
                                </li>
                                @if(!Auth::user()->isAdmin())
                                    <li class="list-group-item text-success text-center"><h5> Boa Sorte! </h5></li>
                                    <li class="list-group-item text-dark text-center">
                                        <h5>{{ucfirst($proof['name'])}}</h5></li>
                                @endif

                            </ul>
                            <div class="card-body text-center">
                                <a href="{{route('proof.topics',$proof['id'])}}"
                                   class="btn btn-lg btn-block bg-success">Iniciar</a>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
@stop

@section('javascript')
    @parent

@endSection
