@extends('layouts.app')

@section('content')
    <br>
    <h3 class="page-title text-center">@lang('quickadmin.topics.title')</h3>
    
    {!! Form::model($topic, ['method' => 'PUT', 'route' => ['topics.update', $topic->id]]) !!}

    <div class="card">
        <div class="card-header">
            @lang('quickadmin.edit')
        </div>

        <div class="card-body">
                <div class="form-group">
                    {!! Form::label('title', 'Title*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
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

