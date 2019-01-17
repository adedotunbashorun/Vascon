<div class="form-body">
        <div class="form-group">
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" type="text" id="name1" name="name1" value="{{ $cinema->name }}" placeholder="e.g.Title" />
            <input class="form-control" type="hidden" id="slug" value="{{ $cinema->id }}" placeholder="e.g.+2349089786756" />
        </div>
        <div class="form-group">
            <label>Location</label>
            <input class="form-control" type="tel" id="location1" value="{{ $cinema->location }}" name="location1" placeholder="e.g Lagos" />
        </div>
    </div>
</div>
<button class="btn btn-primary" id="edit-cinema"><i class="fa fa-plus"></i> Edit Cinema</button>
