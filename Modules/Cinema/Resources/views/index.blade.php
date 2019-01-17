@extends('cinema::layouts.master')
@section('extra_stlye')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{!! config('cinema.name') !!}
                    <button class="btn btn-primary float-right"data-toggle="modal" data-target="#new-cinema" title="Add">Add Cinema</button>
                </div>

                <div class="card-body">
                    <div class="table-responsive m-t-40">
                        @if(count($cinemas) < 1)
                            <div class="danger-alert">
                                <i class="fa fa-warning"></i> <em>There are no cinema available currently. Click on the button above to add  a cinema.</em>
                            </div>
                        @else
                        <table id="cinema" class="display table table-hover table-striped table-bordered cinema">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Added By</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($counter=1)
                                @php($index=0)
                                @forelse($cinemas as $cinema)
                                    <tr>
                                        <td>{{ $counter++}}</td>
                                        <td>{{ $cinema->User->name }}</td>
                                        <td>{{ $cinema->name}} </td>
                                        <td>{{ $cinema->location }}</td>
                                        <td>{{ $cinema->created_at->diffForHumans()}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary">Action</button>
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <input type="hidden" id="cinema_id{{$index}}" value="{{$cinema->id}}">
                                                    <li><a href="javascript:;" id="edit{{$index}}"><i class="icon-note"></i>Edit</a></li>
                                                    <li><a href="javascript:;" data-href="{{ URL::route('cinema.delete',$cinema->id)}}" id="btn_cinema_delete{{$index}}"><i class="fa fa-trash"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @php($index++)
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('cinema::partials.modals._new_cinemas')
    @include('cinema::partials.modals._edit_cinemas')
</div>

@stop
@section('extra_script')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        var TOKEN = "{{csrf_token()}}";
        var USER_ID = "{{ auth()->user()->id }}";
        var SLUG = "{{ bin2hex(random_bytes(64)) }}";
        var DELETE_URL = "{{URL::route('cinema.delete')}}";
        var UPDATE_URL = "{{URL::route('cinema.update')}}";
        var GET_EDIT_INFO = "{{URL::route('cinema.editInfo')}}";
        var ADD_URL = "{{ URL::route('cinema.store')}}";
        $(document).ready( function () {
            $('#cinema').DataTable();
        });
    </script>
    <script src="{{ asset('js/pages/cinemas.js') }}"></script>
@endsection
