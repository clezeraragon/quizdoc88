@extends('layouts.app')
<header>
    <link rel="stylesheet" href="{{asset('multiselect-master/lib/google-code-prettify/prettify.css')}}" />
    <link rel="stylesheet" href="{{asset('multiselect-master/css/style.css')}}" />
    {{--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('/css/app.css')}}" />
</header>
@section('content')
    <h3 class="page-title">@lang('quickadmin.proofs.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['proof.store']]) !!}

    <div class="card">
        <div class="card-header">
            @lang('quickadmin.create')
        </div>
        
        <div class="card-body">
            <div class="col-xs-12">
                <div class="form-group">
                    {!! Form::label('title', 'Titulo da Prova*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('title', 'Topicos*', ['class' => 'control-label']) !!}
                    {!! Form::select('topics',[],null,['class' => 'js-example-basic-multiple','multiple'=>'multiple','name'=>'topics[]'])!!}
                    <p class="help-block"></p>
                    @if($errors->has('topics'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::label('title', 'Usuário*', ['class' => 'control-label']) !!}
                    {!! Form::select('users',[],null,['class' => 'js-data-ajax','multiple'=>'multiple','name'=>'users[]'])!!}
                    <p class="help-block"></p>
                    @if($errors->has('users'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>

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
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: 'Selecione os tópicos',
                width: '100%',
                ajax: {
                    url: '{{route('lists.topics')}}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.title,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            });
            $('.js-data-ajax').select2({
                placeholder: 'Selecione os usuários',
                width: '100%',
                ajax: {
                    url: '{{route('users.lists')}}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

    </script>

@stop

