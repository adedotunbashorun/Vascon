<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Movies\Entities\Movie;
use Modules\Showtime\Entities\Showtime;
use Modules\Cinema\Entities\Cinema;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['movie'] = Movie::count();
        $data['cinema'] = Cinema::count();
        $data['showtime'] = Showtime::count();
        return view('home')->with($data);
    }
}
