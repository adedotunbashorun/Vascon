<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
        <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
        <link href="{{ asset('css/movie.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="flex-center position-ref">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashbord</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
            <div class="container movie-list">
                <center><h1 style="border-bottom: 5px solid #b2b2b2">Vascon Movie Showing At Different Cinema</h1></center>
                <div class="row text-center">
                    @forelse($movies as $movie)
                    @foreach ($movie->Showtime as $key => $showtime)
                        <div class="card">
                            <img class="img-logo" src="http://cdn.collider.com/wp-content/uploads/2017/05/blade-runner-2049-poster-ryan-gosling.jpeg"  alt="Logo"/>
                            <div class="description">
                                <h4 class="movie-title">{{ $movie->title }}</h4>
                                <div class="movie-date">
                                    <i class="fa fa-clock-o"></i>{{ $movie->duration }}
                                </div>
                                <p class="movie_showtime"><b>Showtime:</b> <span><strong>{{ date('D d M y',strtotime($showtime->date)) }} </strong></span><strong>{{ date('h:i a',strtotime($showtime->time)) }}</strong></p>
                                <div class="movie-releasedate">
                                    <div>
                                        <label>Release:</label> {{ date('D d M y',strtotime($movie->release_date)) }}
                                    </div>
                                    <div>
                                        <label>Genre:</label> {{ $movie->genre }}
                                    </div>
                                    <div><label>Language:</label> {{ $movie->language }} </div>
                                </div>
                                <div class="">
                                    <h4 class="movie-title">Showing At </h4>
                                    <center>
                                        {{ $showtime->Cinema->name }}
                                        <p>{{ $showtime->Cinema->location }}</p>
                                    </center>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @empty
                    @endforelse
                </div>

            </div>

    </body>
</html>
