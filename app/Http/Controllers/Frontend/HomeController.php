<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Homes;
use App\Admin\Floor;
use App\Admin\Features;
use App\Admin\Setting;
use App\Admin\FloorPlans;
use Crypt;
use Auth;

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
                $featArr = [];
                foreach($floor->featureList as $feature){
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
                    $featArr[$feature->id] = $feature->toArray();
                    $featArr[$feature->id]['conflicts'] = $conflicts;
                    $featArr[$feature->id]['togetherness'] = $together;
                    $featArr[$feature->id]['dependency'] = $dependency;
                    unset($featArr[$feature->id]['features_acl']);
                }
                foreach($featArr as $k=>$feature){
                    if(!empty($feature['conflicts'])){
                        foreach ($feature['conflicts'] as $conf) {
                            if(!in_array($k, $featArr[$conf]['conflicts'])){
                                $featArr[$conf]['conflicts'][] = (string)$k;
                            }
                        }
                    }
                }
                $ft = [];
                foreach($featArr as $data){
                    $data['conflicts'] = json_encode($data['conflicts']);
                    $data['togetherness'] = json_encode($data['togetherness']);
                    $data['dependency'] = json_encode($data['dependency']);
                    if($data['parent_id']==0){
                        $ft[$data['id']] = $data;
                    }else{
                        $ft[$data['parent_id']]['child_feature'][] = $data;
                    }
                }
                // sort array order_no wise
                array_multisort(array_column($ft, 'order_no'), SORT_ASC, $ft);
                foreach($ft as $k=>$f){
                    $arr = $f['child_feature'];
                    array_multisort(array_column($arr, 'order_no'), SORT_ASC, $arr);
                    $ft[$k]['child_feature'] = $arr;
                }
                $floor->features_data = $ft;
                unset($floor->features);
            }
            
        }
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
        $settings = Setting::where('id', 1)->get()->first();
        $this->data['settings'] = $settings;
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

    public function downloadPDF(Request $request)
    {
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
        $imageName = time().'.png';
        $img->save(public_path('/images/pdf_floor_plans/'.$imageName),100);
        $data['home'] = $home;
        $data['planImage'] = public_path('/images/pdf_floor_plans/'.$imageName);

        // $plans = FloorPlans::create(['user_id' => Auth::user()->id,
        //                                 'floor_id' => $home->floors[0]->id,
        //                                 'home_id' => $request->home_id,
        //                                 'features' => json_encode($features),
        //                                 'image' => 'images/pdf_floor_plans/'.$imageName,
        //                                 'type' => 1,
        //                                 'status' => 1 ]);

        $pdf = \PDF::loadView('frontend.home_pdf',$data)->setPaper('a4', 'portrait');
        return $pdf->download('mandalay.pdf');
    }

}
