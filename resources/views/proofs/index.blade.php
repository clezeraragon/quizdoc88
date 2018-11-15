@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.proofs.title')</h3>

    <p>
        <a href="{{ route('proof.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($proofs) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('quickadmin.proofs.fields.title')</th>
                        <th>&nbsp;Usuário</th>
                        <th>Tópicos</th>
                        <th></th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($proofs) > 0)
                        @foreach ($proofs as $proof)
                            <tr data-entry-id="{{ $proof->id }}">
                                <td></td>
                                <td>{{ $proof->title }}</td>
                                <td>{{ $proof->users->name }}</td>
                                <td>
                                    @foreach($proof->topics as $topic)
                                        {{$topic->title.', '}}
                                        @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('topics.show',[$proof->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    {{--<a href="{{ route('topics.edit',[$proof->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>--}}
                                    {{--{!! Form::open(array(--}}
                                        {{--'style' => 'display: inline-block;',--}}
                                        {{--'method' => 'DELETE',--}}
                                        {{--'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",--}}
                                        {{--'route' => ['topics.destroy', $proof->id])) !!}--}}
                                    {{--{!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}--}}
                                    {{--{!! Form::close() !!}--}}
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
    </script>
@endsection