@extends('layouts.app')

@section('content')
    <br>
    <h3 class="page-title text-center">@lang('quickadmin.roles.title')</h3>
    
    <div class="card">
        <div class="card-header">
            @lang('quickadmin.view')
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr><th>@lang('quickadmin.roles.fields.title')</th>
                    <td>{{ $role->title }}</td></tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('roles.index') }}" class="btn btn-info">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop