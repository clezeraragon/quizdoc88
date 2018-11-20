@extends('layouts.app')

@section('content')
    <br>
    <h3 class="page-title text-center">@lang('quickadmin.results.title')</h3>

    <div class="card">
        <div class="card-header">
            @lang('quickadmin.view-result')
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        @if(Auth::user()->isAdmin())
                        <tr>
                            <th>@lang('quickadmin.results.fields.user')</th>
                            <td>{{ $test->user->name or '' }} ({{ $test->user->email or '' }})</td>
                        </tr>
                        @endif
                        <tr>
                            <th>@lang('quickadmin.results.fields.date')</th>
                            <td>{{ $test->created_at or '' }}</td>
                        </tr>
                        <tr>
                            {{--{{dd($test->result)}}--}}
                            <th>@lang('quickadmin.results.fields.result')</th>
                            <td>{{ $test->result }}/{{(isset($test->getTopicForQuestion->question_id))?\DockQuiz\Models\Question::countQuetionsForTopic($test->getTopicForQuestion->question_id):''}}</td>
                        </tr>
                            <tr>
                                <th>Tópico</th>
                                <td>{{\DockQuiz\Models\Question::getTopic($test->getTopicForQuestion->question_id)}}</td>
                            </tr>

                    </table>
                <?php $i = 1 ?>
                @foreach($results as $result)

                    <table class="table table-bordered table-striped">
                        <tr class="{{ $result->correct ? 'table-success' : 'table-danger' }}">
                            <th style="width: 10%">Questão #{{ $i }}</th>
                            <th>{{ $result->question->question_text or '' }}</th>
                        </tr>
                        @if ($result->question->code_snippet != '')
                            <tr>
                                <td class="text-center"><strong>Exemplo</strong></td>
                                <td><pre class="prettyprint">{!! $result->question->code_snippet !!}</pre></td>
                            </tr>
                        @endif
                        <tr class="{{ $result->correct ? 'table-success' : 'table-danger' }}">
                            <td><strong>Opções</strong></td>
                            <td>
                                <ul>
                                @foreach($result->question->options as $option)
                                    <li style="@if ($option->correct == 1) font-weight: bold; @endif
                                        @if ($result->option_id == $option->id) text-decoration: underline @endif">{{ $option->option }}
                                        @if ($option->correct == 1) <em style="color: #165e1f;">(resposta correta)</em> @endif
                                        @if ($result->option_id == $option->id) <em style="color: #165e1f;">(sua resposta)</em> @endif
                                    </li>
                                @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Explicação</strong></td>
                            <td>
                            {!! $result->question->answer_explanation  !!}
                                @if ($result->question->more_info_link != '')
                                    <br>
                                    <br>
                                    Read more:
                                    <a href="{{ $result->question->more_info_link }}" target="_blank">{{ $result->question->more_info_link }}</a>
                                @endif
                            </td>
                        </tr>
                    </table>
                <?php $i++ ?>
                @endforeach
                </div>
            </div>

            <p>&nbsp;</p>
            @if(Auth::user()->isAdmin())
            <a href="{{ route('proof.dashboard') }}" class="btn btn-info">Ir para meus exames</a>
                @else
                <a href="{{ route('proof.user') }}" class="btn btn-info">Ir para meus exames</a>
            @endif
            <a href="{{ route('results.index') }}" class="btn btn-success">Ver todos os meus resultados</a>
        </div>
    </div>
@stop
