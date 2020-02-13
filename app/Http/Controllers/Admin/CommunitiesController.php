<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HelperTrait;
use App\Admin\Communities;
use Validator;
use App\Validators\CommunitiesValidator;
USE DB;
use File;

class CommunitiesController extends Controller
{
    use HelperTrait, CommunitiesValidator;
    public $title;
    public $data;

    public function __construct(){
        $this->title = 'Communities';
        $this->data['page_title'] = $this->title;
        $this->data['statusArray'] = $this->getStatusArray();
    }

    public function index(){
        $result = Communities::all();
        $this->data['data'] = $result;
        return view('admin.community.index')->with($this->data);
    }

    public function create(){
        $this->data['data'] = '';
        return view('admin.community.create')->with($this->data);
    } 

    public function edit(Request $request, $id){
        $id = $this->decrypt($id);
        $data = Communities::whereId($id)->first();
        $this->data['data'] = $data;
        return view('admin.community.create')->with($this->data);
    }

    public function save(Request $request){
        try{
            $validation = $this->addCommunityValidations($request);
            if($validation['status']==false){
                return response($this->getValidationsErrors($validation));
            }
            if(isset($request->record_id) && $request->record_id!=''){
                $id = $this->decrypt($request->record_id);
                $home = Communities::whereId($id)->first();
                DB::beginTransaction();
                $input = $request->except(['_token','record_id']);
                $result = Communities::whereId($id)->update($input);
                if($result){
                    DB::commit();
                    $response = [
                        'url' => url('admin/communities'),
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
                $result = Communities::insert($input);
                if($result){
                    DB::commit();
                    $response = [
                        'url' => url('admin/communities'),
                        'message' => trans('response.inserted'),
                        'delayTime' => 2000
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
            $result = Communities::whereId($id)->delete();
            if($result){
                DB::commit();
                $response = [
                    'url' => url('admin/communities'),
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
