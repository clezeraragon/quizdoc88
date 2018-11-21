@extends('layouts.app')

@section('content')
    <br>
    <h3 class="page-title text-center">@lang('quickadmin.questions.title')</h3>
    
    <div class="card">
        <div class="card-header">
            @lang('quickadmin.view')
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                      <tr>
                        <th>@lang('quickadmin.questions.fields.topic')</th>
                        <td>{{ $question->topic->title or '' }}</td>
                      </tr>
                      <tr>
                        <th>@lang('quickadmin.questions.fields.question-text')</th>
                        <td>{!! $question->question_text !!}</td>
                      </tr>
                      <tr>
                        <th>@lang('quickadmin.questions.fields.code-snippet')</th>

                        <td><pre class="prettyprint">{!! ($question->code_snippet)?$question->code_snippet:'' !!}</pre></td>
                      </tr>
                      <tr>
                        <th>@lang('quickadmin.questions.fields.answer-explanation')</th>
                        <td>{!! $question->answer_explanation !!}</td>
                      </tr>
                      <tr>
                        <th>@lang('quickadmin.questions.fields.more-info-link')</th>
                        <td>{{ $question->more_info_link }}</td>
                      </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('questions.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop