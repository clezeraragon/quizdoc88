@extends('layouts.app')

@section('content')
    <br>
    <h3 class="page-title text-center">@lang('quickadmin.questions-options.title')</h3>
    
    {!! Form::model($questions_option, ['method' => 'PUT', 'route' => ['questions_options.update', $questions_option->id]]) !!}

    <div class="card">
        <div class="card-header">
            @lang('quickadmin.edit')
        </div>

        <div class="card-body">
          <div class="form-group">
              {!! Form::label('question_id', 'question*', ['class' => 'control-label']) !!}
              {!! Form::select('question_id', $questions, old('question_id'), ['class' => 'form-control']) !!}
              <p class="help-block"></p>
              @if($errors->has('question_id'))
                  <p class="help-block">
                      {{ $errors->first('question_id') }}
                  </p>
              @endif
          </div>
          <div class="form-group">
              {!! Form::label('option', 'Option*', ['class' => 'control-label']) !!}
              {!! Form::text('option', old('option'), ['class' => 'form-control', 'placeholder' => '']) !!}
              <p class="help-block"></p>
              @if($errors->has('option'))
                  <p class="help-block">
                      {{ $errors->first('option') }}
                  </p>
              @endif
          </div>
          <div class="form-group form-check">
              {!! Form::hidden('correct', 0) !!}
              {!! Form::checkbox('correct', 1, old('correct'), ['class' => 'form-check-input', 'for' => 'checkbox_correct']) !!}
              {!! Form::label('correct', 'Correct', ['class' => 'control-label', 'id' => 'correct']) !!}
              <p class="help-block"></p>
              @if($errors->has('correct'))
                <p class="help-block">
                  {{ $errors->first('correct') }}
                </p>
              @endif
          </div>
        </div>
        <div class="card-footer">
         {!! Form::submit(trans('quickadmin.update'), ['class' => 'btn btn-info']) !!}
        </div>
    </div>

    {!! Form::close() !!}
@stop

