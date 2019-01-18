<?php

namespace Modules\Movies\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Movies\Entities\Movie;
use Modules\Movies\Repository\MovieRepository;
use Modules\Movies\Helpers\ImageClass;
use Validator;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    protected $model,$imageupload;

    public function __construct(Movie $movie,ImageClass $imageupload)
    {
        $this->middleware(['auth']);
        // set the model
        $this->imageupload = $imageupload;
        $this->model = new MovieRepository($movie);
    }

    public function index()
    {
        $data['movies'] = $this->model->all();
        return view('movies::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('movies::create');
    }

    protected function MovieValidator(array $data)
	{
		return Validator::make($data, [
            'user_id' => ['required'],
            'slug' => ['required', 'string', 'unique:movies'],
            'title' => ['required', 'string', 'max:255'],
            'release_date' => ['required'],
            'genre' => ['required'],
            'image_name' => ['required|mimes:jpeg,bmp,jpg,png|between:1, 6000'],
		]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validate = $this->MovieValidator($request->except('_token'));
        if($validate->fails()) {
            return $response = [
                'msg' => $validate->errors(),
                'type' => 'false'
            ];
        }
        $image_url = $this->imageupload->image_upload($request->file('image'));
        // create record and pass in only fields that are fillable
        $movie = $this->model->create($request->only($this->model->getModel()->fillable));

        $this->saveImages($movie,$request->file('image'),$image_url);

        if($movie)
            return response()->json([
                'msg'   => "Movie Added Successful!",
                'type'  => "true"
            ],200);
    }

    protected function saveImages($movie,$image_name ,$image_url)
    {
        $image = Movie::find($movie->id);
        $image->image_name = $image_name->getClientOriginalName();
        $image->image_url = $image_url;
        $image->save();
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('movies::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        try {
            $params['movie'] = $this->model->show($request->movie_id);
            return view('movies::partials.partials._movies_details_')->with($params);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        // update model and only pass in the fillable fields
       $this->model->update($request->only($this->model->getModel()->fillable), $request->id);
       $movie = $this->model->show($request->id);
       if($movie)
            return response()->json([
                'msg'   => "Movie Updated Successful!",
                'type'  => "true"
            ],200);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $this->model->delete($id);
        return response()->json([
            'msg'   => "Movie Deleted Successful!",
            'type'  => "true"
        ],200);
    }
}
