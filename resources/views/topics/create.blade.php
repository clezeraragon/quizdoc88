@extends('layouts.app')

@section('content')
    <br>
    <h3 class="page-title text-center">@lang('quickadmin.topics.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['topics.store']]) !!}

    <div class="card">
        <div class="card-header">
            @lang('quickadmin.create')
        </div>
        
        <div class="card-body">
          <div class="form-group">
              {!! Form::label('title', 'Title*', ['class' => 'control-label']) !!}
              {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
              @if($errors->has('title'))
                  <p class="help-block">
                      {{ $errors->first('title') }}
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

