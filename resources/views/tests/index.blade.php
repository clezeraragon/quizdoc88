@extends('layouts.app')

@section('content')
    <h3 class="page-title">Meus Quizes</h3>

    <div class="panel">

        <div class="content">
            <div class="panel-group">
                <div class="col-xs-12">
                    <br>
                    @foreach($topics as $topic)
                        <div class="col-xs-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><h3 class="text-center"> {{$topic->title}}</h3></div>
                                <div class="panel-body">
                                    <p>clique para visualizar o conteúdo</p>
                                @if(\DockQuiz\Result::showForTopic($topic->id))
                                {{--<div class="panel-collapse">--}}
                                    <a href="{{route('get.quests.response',$topic->id)}}" type="button" class="btn btn-warning">Resultado</a>
                               @endif
                                    <a href="{{route('all.quests.topic',$topic->id)}}" type="button" class="btn btn-success"> Começar</a>
                                    <br><br>
                                    <div class="alert alert-success">
                                        <span class="bold" >Total de Perguntas: </span>{{$topic->questions->count()}}</p>
                                        <p><span class="bold" >Total de Acertos: </span>{{\DockQuiz\Service\ServiceDashboard::getTotalAcertos($topic->id)}}</p>
                                        <p><span class="bold" >{{\DockQuiz\Service\ServiceDashboard::totalPorcento(\DockQuiz\Service\ServiceDashboard::getTotalAcertos($topic->id),$topic->questions->count())}}% de Aproveitamento</span></p>
                                    </div>
                                </div>

                                <br>

                            </div>
                            <br>
                        </div>
                    @endforeach

                </div>
            </div>
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
