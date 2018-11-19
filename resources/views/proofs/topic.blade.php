@extends('layouts.app')
<style>
    @import url("http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css");

    body {
        padding-top: 30px;
        padding-bottom: 30px;

    }

    /* COMMON PRICING STYLES */
    .panel.price,
    .panel.price > .panel-heading {
        border-radius: 0px;
        -moz-transition: all .3s ease;
        -o-transition: all .3s ease;
        -webkit-transition: all .3s ease;
    }

    .panel.price:hover {
        box-shadow: 0px 0px 30px rgba(0, 0, 0, .2);
    }

    .panel.price:hover > .panel-heading {
        box-shadow: 0px 0px 30px rgba(0, 0, 0, .2) inset;
    }

    .panel.price > .panel-heading {
        box-shadow: 0px 5px 0px rgba(50, 50, 50, .2) inset;
        text-shadow: 0px 3px 0px rgba(50, 50, 50, .6);
    }

    .price .list-group-item {
        border-bottom-: 1px solid rgba(250, 250, 250, .5);
    }

    .panel.price .list-group-item:last-child {
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
    }

    .panel.price .list-group-item:first-child {
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
    }

    .price .panel-footer {
        color: #fff;
        border-bottom: 0px;
        /*background-color:  rgba(0,0,0, .1);*/
        box-shadow: 0px 3px 0px rgba(0, 0, 0, .3);
    }

    .panel.price .btn {
        box-shadow: 0 -1px 0px rgba(50, 50, 50, .2) inset;
        border: 0px;
    }

    /* green panel */

    .price.panel-green > .panel-heading {
        color: #fff;
        background-color: #57AC57;
        border-color: #71DF71;
        border-bottom: 1px solid #71DF71;
    }

    .price.panel-green > .panel-body {
        color: #fff;
        background-color: #65C965;
    }

    .price.panel-green > .panel-body .lead {
        text-shadow: 0px 3px 0px rgba(50, 50, 50, .3);
    }

    .price.panel-green .list-group-item {
        color: #333;
        background-color: rgba(50, 50, 50, .01);
        font-weight: 600;
        text-shadow: 0px 1px 0px rgba(250, 250, 250, .75);
    }


</style>
@section('content')
    <div class="container-fluid ">
        <h3 class="card-header text-center">Meus Tópicos</h3><br>
        <div class="card-group" style="padding: 1rem;margin-left: 5rem;">
            @if(!$topics)
                <div class="card text-white bg-danger mb-3">
                    <h5 class="card-header">Alerta!!</h5>
                    <div class="card-body">
                        <p class="card-text">Você não possui topicos vinculados!. Por favor contatar o administrador do
                            sistema.</p>
                    </div>
                </div>
            @endif
            @foreach($topics as $topic)


                <div class="card border-success mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h5 class="text-center">{{ucfirst($topic['title'])}}</h5></div>
                    <div class="card-body text-primary">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-dark">
                                <h1 class="text-center text-success">{{$topic['percent']}}%</h1>
                                <h5 class="text-center">De Aproveitamento</h5>
                            </li>

                            <li class="list-group-item text-success text-center"><h5> Total de Perguntas: </h5></li>
                            <li class="list-group-item text-dark text-center">
                                <h5>{{$topic['total_questions']}}</h5>
                            </li>
                            @if(\DockQuiz\Models\Result::showForTopic($topic['topic_id']))
                                <li class="list-group-item text-success text-center"><h5> Total de Acertos: </h5></li>
                                <li class="list-group-item text-dark text-center">
                                    <h5>{{$topic['total_acertos']}}</h5>
                                </li>
                            @endif

                        </ul>
                        <div class="card-body text-center">
                            <div class="panel-collapse">
                                @if(\DockQuiz\Models\Result::showForTopic($topic['topic_id']))
                                    <a href="{{route('get.quests.response',$topic['topic_id'])}}"
                                       class="btn btn-lg btn-block btn-info">Resultado</a>
                                @else
                                    <hr>
                                    <div class="panel-footer">
                                        <a href="{{route('all.quests.topic',$topic['topic_id'])}}"
                                           class="btn btn-lg btn-block" style="background-color:#45B6AF;color:white;">Iniciar</a>
                                    </div>
                                @endif

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
    <script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <script>
        $('.datetime').datetimepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}",
            timeFormat: "hh:mm:ss"
        });
    </script>

@endSection
