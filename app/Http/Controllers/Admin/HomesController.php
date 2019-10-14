<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HelperTrait;
use App\Admin\Homes;
use Validator;
use App\Validators\HomesValidator;
USE DB;
use File;

class HomesController extends Controller
{
    use HelperTrait, HomesValidator;
    public $title;
    public $data;

    public function __construct(){
        $this->title = 'Homes';
        $this->data['page_title'] = $this->title;
        $this->data['statusArray'] = $this->getStatusArray();
    }

    public function index(){
        $result = Homes::all();
        $this->data['data'] = $result;
        return view('admin.homes.index')->with($this->data);
    }

    public function create(){
        $this->data['data'] = '';
        return view('admin.homes.add_update')->with($this->data);
    } 

    public function edit(Request $request, $id){
        $id = $this->decrypt($id);
        $data = Homes::whereId($id)->first();
        $this->data['data'] = $data;
        return view('admin.homes.add_update')->with($this->data);
    }

    public function save(Request $request){
        try{
            $validation = $this->addHomeValidations($request);
            if($validation['status']==false){
                return response($this->getValidationsErrors($validation));
            }
            if(isset($request->record_id) && $request->record_id!=''){
                $id = $this->decrypt($request->record_id);
                $home = Homes::whereId($id)->first();
                DB::beginTransaction();
                $input = $request->except(['_token','record_id']);
                if($request->image){
                    // Delete old image file
                    if($home->image!='' || $home->image!=null || !empty($home->image)){
                        $oldFilePath = public_path().'/images/homes/'.$home->image;
                        File::delete($oldFilePath);
                    }
                    //Upload image to local
                    $image = $request->file('image');   
                    $imageName = time().'.'.$image->getClientOriginalExtension();
                    $destinationImagePath = public_path('images/homes');
                    $uploadStatus = $image->move($destinationImagePath,$imageName);
                    $input['image'] = $imageName;
                }
                $result = Homes::whereId($id)->update($input);
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
                $result = Homes::insert($input);
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

    public function delete(Request $request){
        try{
            $id = $this->decrypt($request->delete_id);
            $home = Homes::whereId($id)->first();
            // Delete image file
            if($home->image!='' || $home->image!=null || !empty($home->image)){
                $filePath = public_path().'/images/homes/'.$home->image;
                File::delete($filePath);
            }
            $result = Homes::whereId($id)->delete();
            if($result){
                DB::commit();
                $response = [
                    'url' => url('admin/homes'),
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
