@extends('layouts.app')

@section('content')
    <br>
    <h3 class="page-title text-center">@lang('quickadmin.results.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['results.store']]) !!}

    <div class="card">
        <div class="card-header">
            @lang('quickadmin.create')
        </div>
        
        <div class="card-body">
          <div class="form-group">
              {!! Form::label('user_id', 'User*', ['class' => 'control-label']) !!}
              {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control']) !!}
              <p class="help-block"></p>
              @if($errors->has('user_id'))
                  <p class="help-block">
                      {{ $errors->first('user_id') }}
                  </p>
              @endif
          </div>
          <div class="form-group">
              {!! Form::label('question_id', 'Question*', ['class' => 'control-label']) !!}
              {!! Form::select('question_id', $questions, old('question_id'), ['class' => 'form-control']) !!}
              <p class="help-block"></p>
              @if($errors->has('question_id'))
                  <p class="help-block">
                      {{ $errors->first('question_id') }}
                  </p>
              @endif
          </div>
          <div class="form-group">
              {!! Form::label('correct', 'Correct*', ['class' => 'control-label']) !!}
              {!! Form::text('correct', old('correct'), ['class' => 'form-control', 'placeholder' => '','autocomplete' => 'off']) !!}
              <p class="help-block"></p>
              @if($errors->has('correct'))
                  <p class="help-block">
                      {{ $errors->first('correct') }}
                  </p>
              @endif
          </div>
          <div class="form-group">
              {!! Form::label('date', 'Date*', ['class' => 'control-label']) !!}
              {!! Form::text('date', old('date'), ['class' => 'form-control datetime', 'placeholder' => '','autocomplete' => 'off']) !!}
              <p class="help-block"></p>
              @if($errors->has('date'))
                  <p class="help-block">
                      {{ $errors->first('date') }}
                  </p>
              @endif
          </div>
            
        </div>
        <div class="card-footer">
          {!! Form::submit(trans('quickadmin.save'), ['class' => 'btn btn-info']) !!}
        </div>
    </div>

    {!! Form::close() !!}
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