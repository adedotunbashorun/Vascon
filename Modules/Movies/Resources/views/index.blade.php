@extends('movies::layouts.master')
@section('extra_stlye')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{!! config('movies.name') !!}
                    <button class="btn btn-primary float-right"data-toggle="modal" data-target="#new-user" title="Add">Add Movie</button>
                </div>

                <div class="card-body">
                    <div class="table-responsive m-t-40">
                        @if(count($movies) < 1)
                            <div class="danger-alert">
                                <i class="fa fa-warning"></i> <em>There are no movies available currently. Click on the button above to add  a movie.</em>
                            </div>
                        @else
                        <table id="movie" class="display table table-hover table-striped table-bordered movies" >
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Added By</th>
                                    <th>Title</th>
                                    <th>Genre</th>
                                    <th>Release Date</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($counter=1)
                                @php($index=0)
                                @forelse($movies as $movie)
                                    <tr>
                                        <td>{{ $counter++}}</td>
                                        <td>{{ strtoupper($movie->User->name) }}</td>
                                        <td>{{ $movie->title}} </td>
                                        <td>{{ $movie->genre }}</td>
                                        <td>{{ $movie->release_date }}</td>
                                        <td>{{ $movie->created_at->diffForHumans()}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary">Action</button>
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <input type="hidden" id="movie_id{{$index}}" value="{{$movie->id}}">
                                                    <li><a href="javascript:;" id="edit{{$index}}"><i class="icon-note"></i>Edit</a></li>
                                                    <li><a href="javascript:;" data-href="{{ URL::route('movies.delete',$movie->id)}}" id="btn_movie_delete{{$index}}"><i class="fa fa-trash"></i>Delete</a></li>
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
    @include('movies::partials.modals._new_movies')
    @include('movies::partials.modals._edit_movies')
</div>

@stop
@section('extra_script')

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        var TOKEN = "{{csrf_token()}}";
        var USER_ID = "{{ auth()->user()->id }}";
        var SLUG = "{{ bin2hex(random_bytes(64)) }}";
        var DELETE_URL = "{{URL::route('movies.delete')}}";
        var UPDATE_URL = "{{URL::route('movies.update')}}";
        var GET_EDIT_INFO = "{{URL::route('movies.editInfo')}}";
        var ADD_URL = "{{URL::route('movies.store')}}";
        $(document).ready( function () {
            $('#movie').DataTable();
        } );
    </script>
    <script src="{{ asset('js/pages/movies.js') }}"></script>
@endsection
