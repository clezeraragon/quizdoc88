@extends('layouts.app')

@section('content')
    <h3 class="page-title">Meus Quizes</h3>

    <div class="panel panel-info">
        <div class="panel-heading">
            {{--@lang('quickadmin.quiz')--}}
        </div>
        <div class="container">
            <div class="panel-group">
                <div class="col-xs-12">
                    <br>
                    @foreach($topics as $topic)
                        <div  class="col-xs-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">{{$topic->title}}</div>
                                <div class="panel-body">clique para visualizar o conteúdo</div>
                                <div class="panel text-center">
                                    <a href="{{route('all.quests.topic',$topic->id)}}" type="button" class="btn btn-success"> Visualizar</a>
                                </div>
                                <br>
                            </div>
                            <br>
                        </div>
                    @endforeach

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

@stop
