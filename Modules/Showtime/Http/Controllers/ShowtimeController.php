<?php

namespace Modules\Showtime\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Showtime\Entities\Showtime;
use Modules\Cinema\Entities\Cinema;
use Modules\Movies\Entities\Movie;
use Modules\Showtime\Repository\ShowTimeRepository;
use Validator;

class ShowtimeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    protected $model;

    public function __construct(Showtime $showtime)
    {
        $this->middleware(['auth']);
        // set the model
        $this->model = new ShowTimeRepository($showtime);
    }

    public function index()
    {
        $data['showtimes'] = $this->model->all();
        $data['cinemas'] = Cinema::all();
        $data['movies'] = Movie::all();
        return view('showtime::index')->with($data);
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('showtime::create');
    }

    protected function ShowtimeValidator(array $data)
	{
		return Validator::make($data, [
            'user_id' => ['required'],
            'movie_id' => ['required'],
            'cinema_id' => ['required'],
            'date' => ['required'],
            'time' => ['required']
		]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validate = $this->ShowtimeValidator($request->except('_token'));
        if($validate->fails()) {
            return $response = [
                'msg' => $validate->errors(),
                'type' => 'false'
            ];
        }
        $data = $request->all();
        foreach($data['movie_id'] as $key => $input) {
            // create record and pass in only fields that are fillable
            $this->model->create([
                'movie_id' => $data['movie_id'][$key], //add a default value here
                'cinema_id' => $data['cinema_id'][$key],
                'user_id' => $data['user_id'],
                'slug' => bin2hex(random_bytes(64)),
                'date' => $data['date'],
                'time' => $data['time']
            ]);
        }
        return response()->json([
            'msg'   => "Showtime Added Successful!",
            'type'  => "true"
        ],200);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('showtime::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        try {
            $params['showtime'] = $this->model->show($request->showtime_id);
            $params['cinemas'] = Cinema::all();
            $params['movies'] = Movie::all();
            return view('showtime::partials.partials._showtimes_details_')->with($params);
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
       $showtime = $this->model->show($request->id);
       if($showtime)
            return response()->json([
                'msg'   => "Showtime Updated Successful!",
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
            'msg'   => "Showtime Deleted Successful!",
            'type'  => "true"
        ],200);
    }
}
