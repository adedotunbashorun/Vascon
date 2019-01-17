<?php

namespace Modules\Cinema\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cinema\Entities\Cinema;
use Modules\Cinema\Repository\CinemaRepository;
use Validator;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    protected $model;

    public function __construct(Cinema $cinema)
    {
        $this->middleware(['auth']);
        // set the model
        $this->model = new CinemaRepository($cinema);
    }

    public function index()
    {
        $data['cinemas'] = $this->model->all();
        return view('cinema::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('cinema::create');
    }

    protected function CinemaValidator(array $data)
	{
		return Validator::make($data, [
            'user_id' => ['required'],
            'slug' => ['required', 'string', 'unique:cinemas'],
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required','string']
		]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validate = $this->CinemaValidator($request->except('_token'));
        if($validate->fails()) {
            return $response = [
                'msg' => $validate->errors(),
                'type' => 'false'
            ];
        }

        // create record and pass in only fields that are fillable
        $cinema = $this->model->create($request->only($this->model->getModel()->fillable));
        if($cinema)
            return response()->json([
                'msg'   => "Cinema Added Successful!",
                'type'  => "true"
            ],200);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('cinema::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        try {
            $params['cinema'] = $this->model->show($request->cinema_id);
            return view('cinema::partials.partials._cinemas_details_')->with($params);
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
       $cinema = $this->model->show($request->id);
       if($cinema)
            return response()->json([
                'msg'   => "CInema Updated Successful!",
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
            'msg'   => "Cinema Deleted Successful!",
            'type'  => "true"
        ],200);
    }
}
