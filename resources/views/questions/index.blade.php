@extends('layouts.app')

@section('content')
    <br>
    <h3 class="page-title text-center">@lang('quickadmin.questions.title')</h3>

    <p>
        <a href="{{ route('questions.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>

    <div class="card">
        <div class="card-header">
            @lang('quickadmin.list')
        </div>

        <div class="card-body">
            <table id="question" class="table table-bordered table-striped {{ count($questions) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        {{--<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>--}}
                        <th>ID</th>
                        <th>@lang('quickadmin.questions.fields.topic')</th>
                        <th>@lang('quickadmin.questions.fields.question-text')</th>
                        <th>Criado</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($questions) > 0)
                        @foreach ($questions as $question)
                            <tr data-entry-id="{{ $question->id }}">
                                <td>{{ $question->id }}</td>
                                <td>{{ $question->topic->title or '' }}</td>
                                <td>{!! $question->question_text !!}</td>
                                <td>{!! $question->created_at->format('d/m/Y H:i:s') !!}</td>
                                <td width="160px">
                                    <a href="{{ route('questions.show',[$question->id]) }}" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="{{ route('questions.edit',[$question->id]) }}" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['questions.destroy', $question->id])) !!}
                                    {!! Form::button('<i class="far fa-trash-alt"></i>', array('type' => 'submit','class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('questions.mass_destroy') }}';
        $(document).ready(function() {
            $('#question').DataTable( {
                buttons: [ 'csv', 'excel', 'pdf', 'print' ]
            } );

        } );
    </script>
@endsection