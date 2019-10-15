<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Homes;
use App\Admin\Floor;
use Crypt;

class HomeController extends Controller
{
	private $data;

    public function index(){
    	$homes = Homes::where('status',1)->get();
    	$defaultHome = Homes::where('status',1)->first();
    	$this->data['homeList'] = $homes;
    	$this->data['defaultHome'] = $defaultHome;
    	return view('frontend.index')->with($this->data);
    }

    public function getFloorsData(Request $request, $id){
    	if($request->ajax()){
    		return 'AJAX';
        	// $homeId = Crypt::decrypt($id);    
        	// Floor::where('home_id',$homeId)->get();	
        }
        return "Unauthorised Access !!!";
    }
}
