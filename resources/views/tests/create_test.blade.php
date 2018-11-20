@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.laravel-quiz')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['tests.store'],'name' => 'store-quest']) !!}
    <input type="hidden" name="topic_id" value="{{ $questions->id }}">
    <div class="card">
        <div class="card-header">
            @lang('quickadmin.quiz')
        </div>

        @if($questions->count() > 0)
          <div class="card-body">
            @php ($i = 1 )
              @foreach($questions->questions as $item)

                @if ($i > 1)
                    <hr/> @endif
                    <div class="form-group">
                        <div class="form-group">
                            <strong><p>Questão {{ $i }}</p>
                              
                            <h3>{!! nl2br($item->question_text) !!}</h3></strong>

                            @if ($questions->code_snippet != '')
                                <div class="code_snippet">{!! $item->code_snippet !!}</div>
                            @endif

                            <input
                                    type="hidden"
                                    name="questions[{{ $i }}]"
                                    value="{{ $item->id }}">
                            @foreach($item->options as $option)
                                <br>
                                <label class="radio-inline">
                                    <input
                                      type="radio"
                                      name="answers[{{ $item->id }}]"
                                      value="{{ $option->id }}"> {{ $option->option }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                @php( $i++)
              @endforeach
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-info" {{$hasResponse}}>{{trans('quickadmin.submit_quiz')}}</button>
            {{--{!! Form::submit(trans('quickadmin.submit_quiz'), ['class' => 'btn btn-info','disable' => 'disable']) !!}--}}
          </div>
        @endif
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
