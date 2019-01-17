<div class="form-body">
        <div class="form-group">
        <div class="form-group">
            <label>Title</label>
            <input class="form-control" type="text" id="title1" name="title" value="{{ $movie->title }}" placeholder="e.g.Title" />
            <input class="form-control" type="hidden" id="slug" value="{{ $movie->id }}" name="genre" placeholder="e.g.+2349089786756" />
        </div>
        <div class="form-group">
            <label>Release Date</label>
            <input class="form-control" type="date" id="release_date1" name="release_date" placeholder="e.g.Date" value="{{ $movie->release_date }}" />
        </div>
        <div class="form-group">
            <label>Genre</label>
            <input class="form-control" type="tel" id="genre1" value="{{ $movie->genre }}" name="genre" placeholder="e.g comedy" />
        </div>
        <div class="form-group">
            <label>Duration</label>
            <input class="form-control" type="text" id="duration1" name="duration" value="{{ $movie->duration }}" placeholder="e.g.1 hour 35 mins" />
        </div>
        <div class="form-group">
            <label>Languare</label>
            <input class="form-control" type="text" id="language1" name="language" value="{{ $movie->language }}" placeholder="e.g. English" />
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="" id="description1" class="form-control" cols="30" rows="5">{{ $movie->description }}</textarea>
        </div>
    </div>
</div>
<button class="btn btn-primary" id="edit-movie"><i class="fa fa-plus"></i> Edit Movie</button>
