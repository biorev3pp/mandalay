<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HelperTrait;
use App\Admin\Homes;
use App\Admin\Floor;
use App\Admin\Features;
use App\Admin\FloorAclSetting;
use Validator;
use App\Validators\FloorValidator;
USE DB;
use File;
use Crypt;

class FloorController extends Controller
{

    use HelperTrait, FloorValidator;
    public $title;
    public $data;

    public function __construct(){
        $this->title = 'Floors';
        $this->data['page_title'] = $this->title;
        $this->data['statusArray'] = $this->getStatusArray();
    }

    public function index($id){
        $homeid = Crypt::decrypt($id);
        $home = Homes::where('id',$homeid)->first();
        $floors = Floor::where('home_id',$homeid)->get();
        $this->data['home'] = $home;
        $this->data['floors'] = $floors;

        return view('admin.floors.index')->with($this->data);
    }

    public function create($id)
    {
        $homeid = Crypt::decrypt($id);
        $home = Homes::find($homeid);
        $this->data['data'] = '';
        $this->data['home'] = $home;
        return view('admin.floors.add_update')->with($this->data);
    }

    public function edit(Request $request, $id){
        $id = $this->decrypt($id);
        $data = Floor::with('home')->whereId($id)->first();
        $this->data['data'] = $data;

        return view('admin.floors.add_update')->with($this->data);
    }

    public function save(Request $request){ 
        try{
            $validation = $this->addFloorValidations($request);
            if($validation['status']==false){
                return response($this->getValidationsErrors($validation));
            }     

            if(isset($request->record_id) && $request->record_id!=''){
                $id = $this->decrypt($request->record_id);
                $floor = Floor::whereId($id)->first();
                DB::beginTransaction();
                $input = $request->except(['_token','record_id','image_update']);
                if($request->image){
                    // Delete old image file
                    if($floor->image!='' || $floor->image!=null || !empty($floor->image)){
                        $oldFilePath = public_path().'/images/floors/'.$floor->image;
                        File::delete($oldFilePath);
                    }
                    //Upload image to local
                    $image = $request->file('image');   
                    $imageName = time().'.'.$image->getClientOriginalExtension();
                    $destinationImagePath = public_path('images/floors');
                    $uploadStatus = $image->move($destinationImagePath,$imageName);
                    $input['image'] = $imageName;
                }
                $result = Floor::whereId($id)->update($input);
                if($result){
                    DB::commit();
                    $response = [
                        'url' => url('admin/floors/list/'.Crypt::encrypt($request->home_id)),
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
                    $destinationImagePath = public_path('images/floors');
                    $uploadStatus = $image->move($destinationImagePath,$imageName);
                    $input['image'] = $imageName;
                }
                $result = Floor::insert($input);
                if($result){
                    DB::commit();
                    $response = [
                        'url' => url('admin/floors/list/'.Crypt::encrypt($request->home_id)),
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
            $floor = Floor::with('features.features_acl')->whereId($id)->first();
            foreach($floor->features as $feature){
                // Delete feature image file
                if($feature->image!='' || $feature->image!=null || !empty($feature->image)){
                    $filePath = public_path().'/images/features/'.$feature->image;
                    File::delete($filePath);
                }
                if($feature->features_acl->id){
                    FloorAclSetting::where('id',$feature->features_acl->id)->delete();
                }
                Features::where('id',$feature->id)->delete();
            }
            // Delete image file
            if($floor->image!='' || $floor->image!=null || !empty($floor->image)){
                $filePath = public_path().'/images/floors/'.$floor->image;
                File::delete($filePath);
            }
            $result = Floor::whereId($id)->delete();
            if($result){
                DB::commit();
                $response = [
                    'url' => url('admin/floors/list/'.Crypt::encrypt($floor->home_id)),
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
}