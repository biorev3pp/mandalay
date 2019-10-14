<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HelperTrait;
use App\Admin\Homes;
use App\Admin\Floor;
use Validator;
use App\Validators\FloorValidator;
use App\Validators\HomesValidator;
USE DB;
use File;

class FloorController extends Controller
{

    public function create($id)
    {
        $data = Homes::find($id);
        return view('admin.floor.index')->with("data", $data);
    }

    public function save(Request $request){
        try{
            $validation = $this->addFloorValidations($request);
            if($validation['status']==false){
                return response($this->getValidationsErrors($validation));
            }
            if(isset($request->home_id) && $request->home_id!=''){
                $id = $this->decrypt($request->home_id);
                $portfolio = Homes::whereId($id)->first();
                DB::beginTransaction();
                $input = $request->except(['_token','home_id']);
                if($request->image){
                    // Delete old image file
                    if($portfolio->image!='' || $portfolio->image!=null || !empty($portfolio->image)){
                        $oldFilePath = public_path().'/images/homes/'.$portfolio->image;
                        File::delete($oldFilePath);
                    }
                    //Upload image to local
                    $image = $request->file('image');   
                    $imageName = time().'.'.$image->getClientOriginalExtension();
                    $destinationImagePath = public_path('images/homes');
                    $uploadStatus = $image->move($destinationImagePath,$imageName);
                    $input['image'] = $imageName;
                }
                $result = Floors::whereId($id)->update($input);
                if($result){
                    DB::commit();
                    $response = [
                        'url' => url('admin/homes'),
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
                    $destinationImagePath = public_path('images/homes');
                    $uploadStatus = $image->move($destinationImagePath,$imageName);
                    $input['image'] = $imageName;
                }
                $result = Floors::insert($input);
                if($result){
                    DB::commit();
                    $response = [
                        'url' => url('admin/homes'),
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
}