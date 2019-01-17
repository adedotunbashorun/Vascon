<div class="form-group">
        <div class="form-group">
            <label for="">Movies</label>
            <select class="form-control" name="" id="movie_id1">
                <option value="">Select a movie</option>
                @forelse($movies as $movie)
                    <option value="{{ $movie->id }}" <?php echo ($showtime->movie_id == $movie->id) ? 'selected' : ''; ?>>{{ $movie->title }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="">Cinema</label>
            <select class="form-control" name="" id="cinema_id1">
                <option value="">Select a movie</option>
                @forelse($cinemas as $cinema)
                    <option value="{{ $cinema->id }}" <?php echo ($showtime->cinema_id == $cinema->id) ? 'selected' : ''; ?>>{{ $cinema->name }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label>Date</label>
            <input class="form-control" type="date" id="date1" value="{{ $showtime->date }}" name="name" placeholder="e.g.Title" />
            <input class="form-control" type="hidden" id="slug" value="{{ $showtime->id }}" name="name" placeholder="e.g.Title" />
        </div>
        <div class="form-group">
            <label>Time</label>
            <input class="form-control" type="time" id="time1" value="{{ $showtime->time }}" name="time" placeholder="e.g. Drama" />
        </div>
    </div>
<button class="btn btn-primary" id="edit-showtime"><i class="fa fa-plus"></i> Edit Showtime</button>
