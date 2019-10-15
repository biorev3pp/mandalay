<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Setting;
use App\Traits\HelperTrait;
use DB;

class SettingController extends Controller
{
    use HelperTrait;
    public $title;
    public $data;

    public function __construct(){
        $this->title = 'Settings';
        $this->data['page_title'] = $this->title;
    }

    public function index(){
        $setting = Setting::first();
        $this->data['setting'] = $setting;
        return view('admin.setting.add_update')->with($this->data);
    }

    public function save(Request $request){
        try{
            // $validation = $this->seoPageValidations($request);
            // if($validation['status']==false){
            //     return response($this->getValidationsErrors($validation));
            // }
            DB::beginTransaction();
            $input = $request->except(['_token','record_id']);
            if($request->logo){
                //Upload image to local
                $image = $request->file('logo');   
                $imageName = 'logo-img.'.$image->getClientOriginalExtension();
                $destinationImagePath = public_path('images');
                $uploadStatus = $image->move($destinationImagePath,$imageName);
                $input['logo'] = $imageName;
            }
            $rc = Setting::whereId(1)->count();
            if($rc > 0){
            	$result = Setting::whereId(1)->update($input);
            }else{
            	$result = Setting::insert($input);
            }
            if($result){
                DB::commit();
                $response = [
                    'url' => url('admin/settings'),
                    'message' => trans('response.updated'),
                    'delayTime' => 2000
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
