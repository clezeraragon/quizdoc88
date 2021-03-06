@extends('layouts.app')

@section('content')
    <br>
    <h3 class="page-title text-center">@lang('quickadmin.questions-options.title')</h3>
    
    <div class="card">
        <div class="card-header">
            @lang('quickadmin.view')
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                          <th>@lang('quickadmin.questions-options.fields.question')</th>
                          <td>{{ $questions_option->question->question_text or '' }}</td>
                        </tr>
                        <tr>
                          <th>@lang('quickadmin.questions-options.fields.option')</th>
                          <td>{{ $questions_option->option }}</td>
                        </tr>
                        <tr>
                          <th>@lang('quickadmin.questions-options.fields.correct')</th>
                          <td>{{ $questions_option->correct == 1 ? 'Yes' : 'No' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('questions_options.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop