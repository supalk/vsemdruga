<?php


namespace App\Http\Controllers;


use App\Helpers\Images;
use http\Env\Request;
use Illuminate\Http\Response;
//use App\Http\Controllers\SubController;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use SubController;

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
     * @return Response
     */
    public function index()
    {
        //$this->init('base');
        return redirect()->route('catalog');
        //return view('main', $this->getParams());
    }


    public function getPhoto($param,$img){
        Images::getImg( $img,$param);
        die;
    }

}