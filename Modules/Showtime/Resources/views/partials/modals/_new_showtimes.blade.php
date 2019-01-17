<div id="new-showtime" class="modal modal-fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="icon-layers font-green"></span> New Showtime</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div id="serverError"></div>
                <div class="form-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Movies</label>
                            <select class="form-control" name="" id="movie_id" multiple>
                                <option value="">Select a movie</option>
                                @forelse($movies as $movie)
                                    <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Cinema</label>
                            <select class="form-control" name="" id="cinema_id" multiple>
                                <option value="">Select a movie</option>
                                @forelse($cinemas as $cinema)
                                    <option value="{{ $cinema->id }}">{{ $cinema->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input class="form-control" type="date" id="date" name="name" placeholder="e.g.Title" />
                        </div>
                        <div class="form-group">
                            <label>Time</label>
                            <input class="form-control" type="time" id="time" name="time" placeholder="e.g. Drama" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="add_showtime"><i class="fa fa-plus"></i> Add showtime</button>
            </div>
        </div>
    </div>
</div>
