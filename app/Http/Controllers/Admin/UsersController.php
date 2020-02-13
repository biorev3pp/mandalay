<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HelperTrait;
use App\Admin\UserRoles;
use App\Admin\UserRolePermissions;
use App\Admin\UserCommunities;
use App\Admin\Communities;
use App\Admin\Modules;
use App\User;
use Validator;
use App\Validators\UsersValidator;
USE DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    use HelperTrait, UsersValidator;
    public $title;
    public $data;

    public function __construct(){
        $this->title = 'Users';
        $this->data['page_title'] = $this->title;
        $this->data['statusArray'] = $this->getStatusArray();
    }

    public function index()
	{
        $result = User::where('user_role_id', '!=', 1)->get();
        $this->data['data'] = $result;
        return view('admin.users.index')->with($this->data);
    }

    public function communities($id = null)
	{
        $fixed_communities = [];
        $id = $this->decrypt($id);
        $user = User::whereId($id)->first();
        $records = UserCommunities::where('user_id', $id)->get();
        foreach ($records as $key => $value) {
            $fixed_communities[] = $value->community_id;
        }
        
        $this->data['user'] = $user;
        $this->data['records'] = $records;
        $this->data['communities'] = Communities::whereNotIn('id', $fixed_communities)->get();
        return view('admin.users.communities')->with($this->data);
    }

    public function create()
	{
        $this->data['data'] = '';
        $all_roles = UserRoles::all();
        foreach ($all_roles as $key => $value) {
            $roles[$value->id] = $value->role;
        }
        $this->data['roles'] = $roles;
        return view('admin.users.create')->with($this->data);
    } 

    public function addcommunity(Request $request)
	{
        try{
                DB::beginTransaction();
                $input = $request->except('_token');
                $result = UserCommunities::insert($input);
                if($result){
                    DB::commit();
                    $response = [
                        'url' => url('admin/users/communities/'.$this->encrypt($request['user_id'])),
                        'message' => trans('response.inserted'),
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
    
    public function save(Request $request){
        try{
            $validation = $this->addUserValidations($request);
            if($validation['status']==false){
                return response($this->getValidationsErrors($validation));
            }
            if(isset($request->record_id) && $request->record_id!=''){
                $id = $this->decrypt($request->record_id);
                $home = User::whereId($id)->first();
                DB::beginTransaction();
                $input = $request->except(['_token','record_id']);
                $result = User::whereId($id)->update($input);
                if($result){
                    DB::commit();
                    $response = [
                        'url' => url('admin/users'),
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
                $input['password'] =  Hash::make($request['password']);
                $result = User::insert($input);
                if($result){
                    DB::commit();
                    $response = [
                        'url' => url('admin/users'),
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

    public function edit(Request $request, $id){
        $id = $this->decrypt($id);
        $data = User::whereId($id)->first();
        $all_roles = UserRoles::all();
        foreach ($all_roles as $key => $value) {
            $roles[$value->id] = $value->role;
        }
        $this->data['roles'] = $roles;
        $this->data['data'] = $data;
        return view('admin.users.create')->with($this->data);
    }

    public function roles(){
        $result = UserRoles::where('id', '!=', 1)->get();
        $this->data['data'] = $result;
        return view('admin.users.roles')->with($this->data);
    }

    public function editPermissions($id = null){
        $id = $this->decrypt($id);
        $data = UserRolePermissions::where('role_id', $id)->get();
        $role = UserRoles::findOrFail($id);
        $modules = Modules::get();
        $this->data['role'] = $role;
        if($data->count() >= 1):
            foreach ($data as $key => $permission) {
                $records[$permission->module_id] = ['id' => $permission->id,
                                                    'plus' => $permission->plus,
                                                    'view' => $permission->view,
                                                    'modify' => $permission->modify,
                                                    'trash' => $permission->trash ];
            }
            $this->data['data'] = $records;
        endif;
        $this->data['modules'] = $modules;
        return view('admin.users.role_permissions')->with($this->data);
    }

    public function savePermissions(Request $request) {
        
        foreach ($request['permission'] as $key => $permission) {
            if(isset($permission['plus'])) $plus = 1; else $plus = 0;
            if(isset($permission['view'])) $view = 1; else $view = 0;
            if(isset($permission['modify'])) $modify = 1; else $modify = 0;
            if(isset($permission['trash'])) $trash = 1; else $trash = 0;
            if(isset($permission['id'])):
                $result = UserRolePermissions::whereId($permission['id'])->update(['plus' => $plus,
                                                                            'view' => $view,
                                                                            'modify' => $modify,
                                                                            'trash' => $trash]);
            else:
                $result = UserRolePermissions::create(['plus' => $plus,
                                            'view' => $view,
                                            'role_id' => $request['role_id'],
                                            'module_id' => $key,
                                            'modify' => $modify,
                                            'trash' => $trash]);

            endif;
        }
        $role_id = $this->encrypt($request->role_id);
        if($result){
            DB::commit();
            $response = [
                'url' => url('admin/users/edit-permissions/'.$role_id),
                'message' => trans('response.updated'),
                'delayTime' => 2000
            ];
            return response($this->getSuccessResponse($response));
        }else{
            DB::rollBack();
            return response($this->getErrorResponse(trans('response.failure')));
        }
    }

    public function deleteCommunity(Request $request){
        try{
            $id = $this->decrypt($request->delete_id);            
            $result = UserCommunities::whereId($id)->delete();
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
