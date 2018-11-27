@extends('layouts.app')

@section('content')
    <br>
    <h3 class="page-title text-center">@lang('quickadmin.results.title')</h3>
    <hr>
    <div class="card">
        <div class="card-header">
            @lang('quickadmin.list')
        </div>

        <div class="card-body">
            <table id="results" class="table table-bordered table-striped {{ count($results) > 0 ? 'datatable' : '' }}">
                <thead>
                <tr>
                    @if(Auth::user()->isAdmin())
                        <th>@lang('quickadmin.results.fields.user')</th>
                    @endif
                    <th>Email</th>
                    <th>Tópico</th>
                    <th>@lang('quickadmin.results.fields.date')</th>
                    <th>Result</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                @if (count($results) > 0)
                    @foreach ($results as $result)
                        <tr>
                            @if(Auth::user()->isAdmin())
                                <td>{{ $result['name']}}</td>
                                <td>{{ $result['email']}}</td>
                            @endif
                            <td>{{ $result['title']}}</td>
                            <td>{{ $result->created_at or '' }}</td>
                            <td>{{ $result['total_acertos'] }}
                                /{{$result['total_questions']}}</td>
                            <td>
                                <a href="{{ route('results.show',[$result['test_id']]) }}"
                                   class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">@lang('quickadmin.no_entries_in_table')</td>
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
        $(document).ready(function () {
            $('#results').DataTable({
                buttons: ['csv', 'excel', 'pdf', 'print']
            });

        });
    </script>
@endsection