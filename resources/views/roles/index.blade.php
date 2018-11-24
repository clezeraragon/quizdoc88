@extends('layouts.app')

@section('content')
    <br>
    <h3 class="page-title text-center">@lang('quickadmin.roles.title')</h3>

    <p>
        <a href="{{ route('roles.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>

    <div class="card">
        <div class="card-header">
            @lang('quickadmin.list')
        </div>

        <div class="card-body">
            <table id="roles" class="table table-bordered table-striped {{ count($roles) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        {{--<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>--}}
                        <th>ID</th>
                        <th>@lang('quickadmin.roles.fields.title')</th>
                        {{--<th>Criado</th>--}}
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($roles) > 0)
                        @foreach ($roles as $role)
                            <tr data-entry-id="{{ $role->id }}">
                                <td>{{$role->id}}</td>
                                <td>{{ $role->title }}</td>
                                {{--<td>{{ $role->created_at->format('d/m/Y H:i:s') }}</td>--}}
                                <td>
                                    <a href="{{ route('roles.show',[$role->id]) }}" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="{{ route('roles.edit',[$role->id]) }}" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['roles.destroy', $role->id])) !!}
                                    {!! Form::button('<i class="far fa-trash-alt"></i>', array('type' => 'submit','class' => 'btn btn-xs btn-danger')) !!}
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
        window.route_mass_crud_entries_destroy = '{{ route('roles.mass_destroy') }}';
        $(document).ready(function() {
            $('#roles').DataTable( {
                responsive: true
            } );

        } );
    </script>
@endsection