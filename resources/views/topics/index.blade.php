@extends('layouts.app')

@section('content')
    <br>
    <h3 class="page-title text-center">@lang('quickadmin.topics.title')</h3>
    <p>
        <a href="{{ route('topics.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>

    <div class="card">
        <div class="card-header">
            @lang('quickadmin.list')
        </div>

        <div class="card-body">
            <table id="topic" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        {{--<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>--}}
                        <th>ID</th>
                        <th>@lang('quickadmin.topics.fields.title')</th>
                        <th>Criado</th>
                        <th></th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($topics) > 0)
                        @foreach ($topics as $topic)
                            <tr data-entry-id="{{ $topic->id }}">
                                <td>{{ $topic->id }}</td>
                                <td>{{ $topic->title }}</td>
                                <td>{{ $topic->created_at->format('d/m/Y H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('topics.show',[$topic->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    <a href="{{ route('topics.edit',[$topic->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['topics.destroy', $topic->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('topics.mass_destroy') }}';
        $(document).ready(function() {
            $('#topic').DataTable( {
                buttons: [ 'csv', 'excel', 'pdf', 'print' ]
            } );

        } );
    </script>
@endsection