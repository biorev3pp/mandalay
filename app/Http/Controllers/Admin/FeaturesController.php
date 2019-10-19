<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HelperTrait;
use App\Admin\Homes;
use App\Admin\Floor;
use App\Admin\Features;
use Validator;
use App\Validators\FloorValidator;
use App\Validators\FeatureValidator;
USE DB;
use File;
use Crypt;

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
        $features = Features::where('floor_id',$floorid)->get();
        $this->data['floor'] = $floor;
        $this->data['features'] = $features;
        return view('admin.features.index')->with($this->data);
    }

    public function create($id)
    {
        $floorid = Crypt::decrypt($id);
        $floor = Floor::find($floorid);
        $this->data['data'] = '';
        $this->data['floor'] = $floor;
        return view('admin.features.add_update')->with($this->data);
    }

    public function edit(Request $request, $id){
        $id = $this->decrypt($id);
        $data = Features::with('floor')->whereId($id)->first();
        $floor = Floor::where('id',$data->floor_id)->first();
        $this->data['floor'] = $floor;
        $this->data['data'] = $data;
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

    public function setFeatureOption($id){
        $floorid = Crypt::decrypt($id);
        $floor = Floor::find($floorid);
        $features = Features::where('floor_id',$floorid)->pluck('title','id');
        $this->data['data'] = '';
        $this->data['floor'] = $floor;
        $this->data['features'] = $features;
        return view('admin.features.set_features_option')->with($this->data);
    }
}
