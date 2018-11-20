@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.topics.title')</h3>
    
    <div class="card">
        <div class="card-header">
            @lang('quickadmin.view')
        </div>
        
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tr>
                  <th>@lang('quickadmin.topics.fields.title')</th>
                  <td>{{ $topic->title }}</td>
                </tr>
            </table>

        </div>
        <div class="card-footer">
            <a href="{{ route('topics.index') }}" class="btn btn-success">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop