<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Homes;
use App\Admin\Floor;
use App\Admin\Features;
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

    public function finalHomePage(Request $request){
        $features = $request->feature_id;
        if(!isset($features)){
            $features = array();
        }
        $home = Homes::with(['floors'=>function($q) use ($features){
            $q->with('features')->whereHas('features',function($w) use ($features){
                $w->whereIn('id',$features);
            });
        }])->where('id',$request->home_id)->first();
        $this->data['home'] = $home;
        $this->data['features'] = $features;
        return view('frontend.final')->with($this->data);
    }

    public function getFloorsData(Request $request){
    	if($request->ajax()){
        	$data = Floor::where('id',$request->floorid)->first();	
            $data->image =  asset('/images/floors/'.$data->image);
            return response()->json($data);
        }
        return "Unauthorised Access !!!";
    }

    public function getFeatureData(Request $request){
        if($request->ajax()){
            $data = Features::where('id',$request->featureid)->first();  
            $data->image =  asset('/images/features/'.$data->image);
            return response()->json($data);
        }
        return "Unauthorised Access !!!";
    }
}
