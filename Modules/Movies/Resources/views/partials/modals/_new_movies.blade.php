<div id="new-user" class="modal modal-fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="icon-layers font-green"></span> New Movie</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div id="serverError"></div>
                <div class="form-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" type="text" id="title" name="title" placeholder="e.g.Title" />
                        </div>
                        <div class="form-group">
                            <label>Release Date</label>
                            <input class="form-control" type="date" id="release_date" name="release_date" placeholder="e.g. Date" />
                        </div>
                        <div class="form-group">
                            <label>Genre</label>
                            <input class="form-control" type="text" id="genre" name="genre" placeholder="e.g. Drama" />
                        </div>
                        <div class="form-group">
                            <label>Duration</label>
                            <input class="form-control" type="text" id="duration" name="duration" placeholder="e.g.1 hour 35 mins" />
                        </div>
                        <div class="form-group">
                            <label>Languare</label>
                            <input class="form-control" type="text" id="language" name="language" placeholder="e.g. English" />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="" id="description" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="add_movies"><i class="fa fa-plus"></i> Add Movie</button>
            </div>
        </div>
    </div>
</div>
