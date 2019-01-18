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
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
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
            <div class="container movie-list">
                <center class="header"><h1 style="border-bottom: 5px solid #b2b2b2;">Vascon Movie Showing At Different Cinema</h1></center>
                <div class="row text-center">
                    @forelse($movies as $movie)
                    @foreach ($movie->Showtime as $key => $showtime)
                        <div class="card">
                            <img class="img-logo" src="{{ $movie->image_url }}"  alt="Logo"/>
                            <div class="description">
                                <h4 class="movie-title">{{ $movie->title }}</h4>
                                <div class="movie-date">
                                    <i class="fa fa-clock-o"></i> {{ $movie->duration }}
                                </div>
                                <p class="movie_showtime"><b>Showtime:</b> <span><strong>{{ date('D d, M Y',strtotime($showtime->date)) }} </strong></span> - <strong>{{ date('h:i a',strtotime($showtime->time)) }}</strong></p>
                                <div class="movie-releasedate">

                                    <label>Release:</label> {{ date('D d M y',strtotime($movie->release_date)) }}<br/>
                                    <label>Genre:</label> {{ $movie->genre }}<br/>
                                    <label>Language:</label> {{ $movie->language }}<br/>

                                </div>
                                <div class="">
                                    <h3 class="">Showing At </h3>
                                    <center>
                                        <p>
                                            <span class="cinema">{{ $showtime->Cinema->name }}</span><br/>
                                            {{ $showtime->Cinema->location }}
                                        </p>
                                    </center>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @empty
                    @endforelse
                </div>

            </div>
        </div>


    </body>
</html>
