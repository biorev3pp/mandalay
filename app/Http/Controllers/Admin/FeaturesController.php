<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HelperTrait;
use App\Admin\Homes;
use App\Admin\FloorAclSetting;
use App\Admin\Floor;
use App\Admin\Features;
use App\Admin\FeatureGroup;
use Validator;
use App\Validators\FloorValidator;
use App\Validators\FeatureValidator;
USE DB;
use File;
use Crypt;
use Auth;
use Illuminate\Support\Str;

class FeaturesController extends Controller
{
    use HelperTrait, FeatureValidator;
    public $title;
    public $data;

    public function __construct(){
        $this->title = 'Features';
        $this->data['page_title'] = $this->title;
        $this->data['statusArray'] = $this->getStatusArray();
    }

    public function index($id){
        $floorid = Crypt::decrypt($id);
        $floor = Floor::where('id',$floorid)->first();
        $features = Features::with('feature_groups')->where('floor_id',$floorid)->where('parent_id',0)->get();
        $this->data['floor'] = $floor;
        $this->data['features'] = $features;
        return view('admin.features.index')->with($this->data);
    }

    public function create($id)
    {
        $floorid = Crypt::decrypt($id);
        $floor = Floor::find($floorid);
        $features = Features::where('floor_id',$floorid)->where('parent_id',0)->pluck('title','id')->prepend('None','0');
        $this->data['data'] = '';
        $this->data['floor'] = $floor;
        $this->data['features'] = $features;
        return view('admin.features.add_update')->with($this->data);
    }

    public function edit(Request $request, $id){
        $id = $this->decrypt($id);
        $data = Features::with('floor')->whereId($id)->first();
        $floor = Floor::where('id',$data->floor_id)->first();
        $features = Features::where('floor_id',$data->floor_id)->where('parent_id',0)->where('id','!=',$id)->pluck('title','id')->prepend('None','0');
        $this->data['floor'] = $floor;
        $this->data['data'] = $data;
        $this->data['features'] = $features;
        return view('admin.features.add_update')->with($this->data);
    }

    public function save(Request $request){
        try{
            $validation = $this->addFeatureValidations($request);
            if($validation['status']==false){
                return response($this->getValidationsErrors($validation));
            }
            if(isset($request->record_id) && $request->record_id!=''){
                $id = $this->decrypt($request->record_id);
                $floor = Features::whereId($id)->first();
                DB::beginTransaction();
                $input = $request->except(['_token','record_id','image_update']);
                if($request->image){
                    // Delete old image file
                    if($floor->image!='' || $floor->image!=null || !empty($floor->image)){
                        $oldFilePath = public_path().'/images/features/'.$floor->image;
                        File::delete($oldFilePath);
                    }
                    //Upload image to local
                    $image = $request->file('image');
                    $imageName = time().'.'.$image->getClientOriginalExtension();
                    $destinationImagePath = public_path('images/features');
                    $uploadStatus = $image->move($destinationImagePath,$imageName);
                    $input['image'] = $imageName;
                }
                $result = Features::whereId($id)->update($input);
                if($result){
                    DB::commit();
                    $response = [
                        'url' => url('admin/features/list/'.Crypt::encrypt($request->floor_id)),
                        'message' => trans('response.updated'),
                        'delayTime' => 2000
                    ];
                    return response($this->getSuccessResponse($response));
                }else{
                    DB::rollBack();
                    return response($this->getErrorResponse(trans('response.failure')));
                }
            }else{
                DB::beginTransaction();
                $input = $request->except('_token');
                if($request->image){
                    //Upload image to local
                    $image = $request->file('image');
                    $imageName = time().'.'.$image->getClientOriginalExtension();
                    $destinationImagePath = public_path('images/features');
                    $uploadStatus = $image->move($destinationImagePath,$imageName);
                    $input['image'] = $imageName;
                }
                $rowCount = Features::count();
                $input['order_no'] = $rowCount+1;
                $result = Features::insert($input);
                if($result){
                    DB::commit();
                    $response = [
                        'url' => url('admin/features/list/'.Crypt::encrypt($request->floor_id)),
                        'message' => trans('response.inserted'),
                        'delayTime' => 1000
                    ];
                    return response($this->getSuccessResponse($response));
                }else{
                    DB::rollBack();
                    return response($this->getErrorResponse(trans('response.failure')));
                }
            }
        }catch(\Exception $e){
            return response($this->getErrorResponse($e->getMessage()));
        }
    }



    public function delete(Request $request){
        try{
            $id = $this->decrypt($request->delete_id);
            $features = Features::whereId($id)->first();
            // Delete image file
            if($features->image!='' || $features->image!=null || !empty($features->image)){
                $filePath = public_path().'/images/features/'.$features->image;
                File::delete($filePath);
            }
            FloorAclSetting::where('feature_id',$id)->delete();
            if($features->parent_id == 0){
                $childFeatures = Features::where('parent_id',$features->id)->pluck('id');
                Features::whereIn('id',$childFeatures)->delete();   
            }
            $result = Features::whereId($id)->delete();
            if($result){
                DB::commit();
                $response = [
                    'url' => url('admin/features/list/'.Crypt::encrypt($features->floor_id)),
                    'message' => trans('response.removed'),
                    'delayTime' => 1000
                ];
                return response($this->getSuccessResponse($response));
            }else{
                DB::rollBack();
                return response($this->getErrorResponse(trans('response.failure')));
            }
        }catch(\Exception $e){
            return response($this->getErrorResponse($e->getMessage()));
        }
    }


    public function deleteAclSettings(Request $request){
        try{
            $id = $request->delete_id;
            // $result  = FloorAclSetting::where('id',$id)->delete();
            $result = 1;    
            if($result){
                DB::commit();
                $response = [
                    'delete_id' => $id,
                    'modelhide' => '#modal-delete',
                    'message' => trans('response.removed'),
                    'delayTime' => 1000
                ];
                return response($this->getSuccessResponse($response));
            }else{
                DB::rollBack();
                return response($this->getErrorResponse(trans('response.failure')));
            }
        }catch(\Exception $e){
            return response($this->getErrorResponse($e->getMessage()));
        }
    }

    public function getACLRow(Request $request){
        if($request->ajax()){
            $floorid = $request->floorid;
            $idString = Str::random(5);
            $features = Features::where('floor_id',$floorid)->where('parent_id','!=',0)->pluck('title','id');
            $this->data['features'] = $features;
            $this->data['index'] = $request->index;
            $this->data['idstr'] = $idString;
            return view('admin.features.acl_row')->with($this->data)->render(); 
        }
        return "Unauthorised Access !!!";
    }

    public function setACLOptions($id){
        $floorid = Crypt::decrypt($id);
        $floor = Floor::find($floorid);
        $idString = Str::random(5);
        $features = Features::where('floor_id',$floorid)->where('parent_id','!=',0)->pluck('title','id');
        $aclSettings = FloorAclSetting::where('floor_id',$floorid)->get();
        $this->data['data'] = '';
        $this->data['floor'] = $floor;
        $this->data['features'] = $features;
        $this->data['idstr'] = $idString;
        $this->data['acl_settings'] = $aclSettings->toArray();
        return view('admin.features.acl_settings')->with($this->data);
    }

    public function saveAclSettings(Request $request)
    {
        $floorid = $request->floorid;
        $post = \Arr::except($request->all(),['_token']);
        $prepareData = [];
        try{
            DB::beginTransaction();
            $i = 0;
            foreach($post['feature_id'] as $featureid){
                $i++;
                $prepareData[] = [
                    'user_id'       => Auth::id(),
                    'feature_id'    => $featureid,
                    'floor_id'      => $floorid,
                    'conflicts'     => (isset($post['conflict'][$i])) ? json_encode($post['conflict'][$i]) : null,
                    'dependency'    => (isset($post['dependency'][$i])) ? json_encode($post['dependency'][$i]) : null,
                    'togetherness'  => (isset($post['togetherness'][$i])) ? json_encode($post['togetherness'][$i]) : null,
                ];
            }
            //In case of update 
            $result = FloorAclSetting::where('floor_id',$floorid)->delete();
            $result = FloorAclSetting::insert($prepareData);
            if($result){
                DB::commit();
                $response = [
                    'message' => trans('response.updated'),
                    'delayTime' => 1000,
                    'acl_settings' => true,
                    'url' => url('admin/features/set-acl/'.Crypt::encrypt($floorid))
                ];
                return response($this->getSuccessResponse($response));
            }else{
                DB::rollBack();
                return response($this->getErrorResponse(trans('response.failure')));
            }
        }catch(\Exception $e){
            return response($this->getErrorResponse($e->getMessage()));
        }
    }
    public function reOrderList(Request $request){
        $orderData = $request->order;
        foreach($orderData as $order){
            Features::where('id',$order['id'])->update(['parent_id'=>$order['parent_id'],'order_no'=>$order['order']]);
        }
        return response(['success'=>true,'message'=>'Reordering Done!']);
    }
}
