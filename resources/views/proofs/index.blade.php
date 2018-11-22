@extends('layouts.app')

@section('content')
    <div class="container-fluid">
    <div class="col-xs-12">
        <div class="col-xs-8">
            <br>
            <h3 class="page-title text-center">@lang('quickadmin.proofs.title')</h3>
        </div>
        <div class="col-xs-4">
            <p>
                <a href="{{ route('proof.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
            </p>
        </div>
    </div>
    </div>
    <div class="card">
        <div class="card-header">
            @lang('quickadmin.list')
        </div>

        <div class="card-body">
            <table id ="proof" class="table table-bordered table-strip" style="width:100%">
                <thead>
                  <tr>
                      {{--<th style="text-align:center;"><input type="checkbox" id="select-all"/></th>--}}
                      <th>ID</th>
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
                            <td>{{ $proof->id }}</td>
                            <td>{{ $proof->title }}</td>
                            <td>{{ (isset($proof->users->name))?$proof->users->name:'' }}</td>
                            <td>
                                @foreach($proof->topics as $topic)
                                    {{$topic->title.', '}}
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('topics.show',[$proof->id]) }}"
                                   class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
                      <td></td>
                      <td>@lang('quickadmin.no_entries_in_table')</td>
                        <td></td>
                        <td></td>
                        <td></td>
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
          $('#proof').DataTable( {
              //  buttons: [ 'csv', 'excel', 'pdf', 'print' ]
            } );

        } );
    </script>
@endsection