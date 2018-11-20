@extends('layouts.app')

@section('content')
    <br>
    <h3 class="page-title text-center">@lang('quickadmin.users.title')</h3>
    
    {!! Form::model($user, ['method' => 'PUT', 'route' => ['users.update', $user->id]]) !!}

    <div class="card">
        <div class="card-header">
            @lang('quickadmin.edit')
        </div>

        <div class="card-body">
          <div class="form-group">
              {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
              {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
              <p class="help-block"></p>
              @if($errors->has('name'))
                  <p class="help-block">
                      {{ $errors->first('name') }}
                  </p>
              @endif
          </div>
          <div class="form-group">
              {!! Form::label('email', 'Email*', ['class' => 'control-label']) !!}
              {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '']) !!}
              <p class="help-block"></p>
              @if($errors->has('email'))
                  <p class="help-block">
                      {{ $errors->first('email') }}
                  </p>
              @endif
          </div>
          <div class="form-group">
              {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
              {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '']) !!}
              <p class="help-block"></p>
              @if($errors->has('password'))
                  <p class="help-block">
                      {{ $errors->first('password') }}
                  </p>
              @endif
          </div>
          <div class="form-group">
              {!! Form::label('role_id', 'Role*', ['class' => 'control-label']) !!}
              {!! Form::select('role_id', $roles, old('role_id'), ['class' => 'form-control']) !!}
              <p class="help-block"></p>
              @if($errors->has('role_id'))
                  <p class="help-block">
                      {{ $errors->first('role_id') }}
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

