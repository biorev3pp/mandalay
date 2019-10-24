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
        \DB::enableQueryLog();
    	$homes = Homes::with('floors.features.features_acl')->where('status',1)->get();
        // dd(\DB::getQueryLog());
    	$defaultHome = Homes::where('status',1)->first();
        // echo "<pre>";
        // print_r($homes[0]['floors'][0]['features'][0]['features_acl']->toArray());
    	$this->data['homeList'] = $homes;
    	$this->data['defaultHome'] = $defaultHome;

    	return view('frontend.index')->with($this->data);
    }

    public function finalHomePage(Request $request){
        // $this->print($request->all());
        $features = $request->feature_id;
        if(!isset($features)){
            $features = array();
        }
        // $features = Features::whereIn('id',$features)->get();
        
        // foreach($features as $feature){
        //     $fl = $feature->floor->toArray();
        //     array_push($fl,$feature->toArray());
        //     // $fl['features'][] = $feature->toArray();
        //     $floors[$fl['id']]=$fl;
        //     // $floors[]['floor'] = $feature->toArray();
        // }
        // $this->print($floors);
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

            if(is_string($request->featureid)) {
                $data = Features::where('id',$request->featureid)->first();  
                $data->image =  asset('/images/features/'.$data->image);
            }else {
                $where = $request->featureid;
                $data = Features::whereIn('id',$where)->get();
                foreach ($data as $key => $value) {
                    $data[$key]->image =  asset('/images/features/'.$value->image);
                }  
            }
            return response()->json($data);
        }
        return "Unauthorised Access !!!";
    }

    public function testPDF(){
        $pdf = \PDF::loadView('frontend.home_pdf');
        return $pdf->download('mandalay.pdf');
    }
}
