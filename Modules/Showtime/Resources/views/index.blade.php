@extends('showtime::layouts.master')
@section('extra_stlye')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{!! config('showtime.name') !!}
                    <button class="btn btn-primary float-right"data-toggle="modal" data-target="#new-showtime" title="Add">Add Show Time</button>
                </div>

                <div class="card-body">
                    <div class="table-responsive m-t-40">
                        @if(count($showtimes) < 1)
                            <div class="danger-alert">
                                <i class="fa fa-warning"></i> <em>There are no show available currently. Click on the button above to add  a showtime.</em>
                            </div>
                        @else
                        <table id="showtime" class="display table table-hover table-striped table-bordered showtime" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Added By</th>
                                    <th>Movie Title</th>
                                    <th>Cinema</th>
                                    <th>Date Time</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($counter=1)
                                @php($index=0)
                                @forelse($showtimes as $showtime)
                                    <tr>
                                        <td>{{ $counter++}}</td>
                                        <td>{{ strtoupper($showtime->User->name) }}</td>
                                        <td>{{ $showtime->Movies->title }} </td>
                                        <td>{{ $showtime->Cinema->name }}</td>
                                        <td>{{ date('D d M y - h:ia', strtotime($showtime->date .' '. $showtime->time)) }}</td>
                                        <td>{{ $showtime->created_at->diffForHumans()}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary">Action</button>
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <input type="hidden" id="showtime_id{{$index}}" value="{{$showtime->id}}">
                                                    <li><a href="javascript:;" id="edit{{$index}}"><i class="icon-note"></i>Edit</a></li>
                                                    <li><a href="javascript:;" data-href="{{ URL::route('showtime.delete',$showtime->id)}}" id="btn_showtime_delete{{$index}}"><i class="fa fa-trash"></i>Delete</a></li>
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
    @include('showtime::partials.modals._new_showtimes')
    @include('showtime::partials.modals._edit_showtimes')
</div>

@stop
@section('extra_script')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        var TOKEN = "{{csrf_token()}}";
        var USER_ID = "{{ auth()->user()->id }}";
        var DELETE_URL = "{{URL::route('showtime.delete')}}";
        var UPDATE_URL = "{{URL::route('showtime.update')}}";
        var GET_EDIT_INFO = "{{URL::route('showtime.editInfo')}}";
        var ADD_URL = "{{URL::route('showtime.store')}}";
        $(document).ready( function () {
            $('#showtime').DataTable();
        });
    </script>
    <script src="{{ asset('js/pages/showtime.js') }}"></script>
@endsection

