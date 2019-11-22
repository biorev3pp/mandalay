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
        $homes = Homes::where('status',1)->get();
        // $this->print($homes->toArray());
        $featureData = [];
        foreach($homes as $home){
            foreach($home->floors as $floor){
                foreach($floor->featureList as $feature){
                    $featureID = $feature->id;
                    $conflicts = [];
                    $together = [];
                    $dependency = [];
                    if($feature->features_acl->conflicts){
                        $conflicts = json_decode($feature->features_acl->conflicts);
                    }
                    if($feature->features_acl->togetherness){
                        $together = json_decode($feature->features_acl->togetherness);
                    }
                    if($feature->features_acl->dependency){
                        $dependency = json_decode($feature->features_acl->dependency);
                    }
                    // Loop through all features added 
                    foreach($floor->featureList as $featureArr){
                        // add conflicts value to current feature
                        if($featureArr->id == $featureID){
                            if(isset($conflicts) && !empty($conflicts)){
                                $featureArr->conflicts = json_encode($conflicts);
                            }
                        }
                        // set current feature as conflict
                        if(in_array($featureArr->id, $conflicts)){
                            if(isset($featureArr->conflicts) && !empty($featureArr->conflicts)){
                                $addedConf = json_decode($featureArr->conflicts);
                                array_push($addedConf, $featureID);    
                                $featureArr->conflicts = json_encode($addedConf);
                            }else{
                                $newConf = array((string)$featureID);
                                $featureArr->conflicts = json_encode($newConf);
                            }
                        }
                        // add togetherness value to current feature
                        if($featureArr->id == $featureID){
                            if(isset($together) && !empty($together)){
                                $featureArr->togetherness = json_encode($together);
                            }
                        }
                        // set current feature as togetherness
                        if(in_array($featureArr->id, $together)){
                            if(isset($featureArr->togetherness)){
                                $addedTog = json_decode($featureArr->together);
                                array_push($addedTog, $featureID);    
                                $featureArr->togetherness = json_encode($addedTog);
                            }else{
                                $newTog = array((string)$featureID);
                                $featureArr->togetherness = json_encode($newTog);
                            }
                        }
                        // add dependency value to current feature
                        if($featureArr->id == $featureID){
                            if(isset($dependency) && !empty($dependency)){
                                $featureArr->dependency = json_encode($dependency);
                            }
                        }
                    }
                    unset($feature->features_acl);
                    $featureData[$feature->id] = $feature->toArray();
                }
                $ft = [];
                foreach($featureData as $data){
                    if($data['parent_id']==0){
                        $ft[$data['id']] = $data;
                    }else{
                        if(!isset($data['conflicts'])){
                            $data['conflicts'] = '';
                        }
                        if(!isset($data['togetherness'])){
                            $data['togetherness'] = '';
                        }
                        if(!isset($data['dependency'])){
                            $data['dependency'] = '';
                        }
                        $ft[$data['parent_id']]['child_feature'][] = $data;
                    }
                }
                $floor->features_data = $ft;
                unset($floor->features);
            }
            
        }
        // $this->print($homes->toArray());
        // die;
        // dd(\DB::getQueryLog());
        $defaultHome = Homes::where('status',1)->first();
        // echo "<pre>";
        // print_r($homes[0]['floors'][0]['features'][0]['features_acl']->toArray());
        $this->data['homeList'] = $homes;
        $this->data['defaultHome'] = $defaultHome;

        return view('frontend.index')->with($this->data);




     //    \DB::enableQueryLog();
    	// $homes = Homes::with(['floors.features'=>function($q){
     //        $q->with('feature_groups.features_acl')->where('parent_id',0);
     //    }])->where('status',1)->get();
     //    // dd(\DB::getQueryLog());
    	// $defaultHome = Homes::where('status',1)->first();
     //    // echo "<pre>";
     //    // print_r($homes[0]['floors'][0]['features'][0]['features_acl']->toArray());
    	// $this->data['homeList'] = $homes;
    	// $this->data['defaultHome'] = $defaultHome;

    	// return view('frontend.index')->with($this->data);
    }

    public function finalHomePage(Request $request){
        // $this->print($request->all());
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
            $features = $request->featureid;
            $data = array();
            if(!empty($features)){
                $data = Features::whereIn('id',$features)->get();
                foreach ($data as $key => $value) {
                    $data[$key]->image =  asset('/images/features/'.$value->image);
                }    
            }
            return response()->json($data);
        }
        return "Unauthorised Access !!!";
    }

    public function testPDF(){
        $data = array('name'=>'Ranjan');
        $pdf = \PDF::loadView('frontend.home_pdf',$data)->setPaper('a4', 'portrait');
        return $pdf->stream('mandalay.pdf');
    }

    public function downloadPDF(Request $request){
        ini_set('memory_limit', '-1');
        $features = $request->feature_id;
        $home = Homes::with(['floors'=>function($q) use ($features){
            $q->with('features')->whereHas('features',function($w) use ($features){
                $w->whereIn('id',$features);
            });
        }])->where('id',$request->home_id)->first();
        $floorImage = public_path('/images/floors/'.$home->floors[0]->image);
        // Create Image Instance
        $img = \Image::make($floorImage);
        foreach($home->floors as $floor){
            foreach ($floor->features as $key => $value) {
                if(!in_array($value->id, $features)){
                    unset($floor->features[$key]);
                }else{
                    $featureImage = public_path('/images/features/'.$value->image);
                    // Insert all images to combine together
                    $img->insert($featureImage);
                }
            }
        }
        //save combined image 
        $imageName = time().'.png';
        $img->save(public_path('/images/pdf_floor_plans/'.$imageName),100);
        $data['home'] = $home;
        $data['planImage'] = public_path('/images/pdf_floor_plans/'.$imageName);
        $pdf = \PDF::loadView('frontend.home_pdf',$data)->setPaper('a4', 'portrait');
        return $pdf->download('mandalay.pdf');
    }
}
