@extends('layouts.app')

@section('content')
    <br>
    <h3 class="page-title text-center">@lang('quickadmin.users.title')</h3>
    
    <div class="card">
        <div class="card-header">
            @lang('quickadmin.view')
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr><th>@lang('quickadmin.users.fields.name')</th>
                    <td>{{ $user->name }}</td></tr><tr><th>@lang('quickadmin.users.fields.email')</th>
                    <td>{{ $user->email }}</td></tr><tr><th>@lang('quickadmin.users.fields.password')</th>
                    <td>---</td></tr><tr><th>@lang('quickadmin.users.fields.role')</th>
                    <td>{{ $user->role->title or '' }}</td></tr><tr><th>@lang('quickadmin.users.fields.remember-token')</th>
                    <td>{{ $user->remember_token }}</td></tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('users.index') }}" class="btn btn-info">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop