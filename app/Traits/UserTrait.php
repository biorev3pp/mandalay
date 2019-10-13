<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;

trait UserTrait
{

    public $recordLimit = 10;

    /**
     * @param   : $request
     * @response: response
     * @method  : saveMusic
     * @purpose : Save music into Database
     */
    public function changeAdminPassword($request){
        $post = $request->except(['_token','confirm_password']);
        $check = Hash::check($post['current_password'], Auth::user()->password);
        if($check){
            $password = Hash::make($post['new_password']);
            $result = User::whereId(Auth::user()->id)->update(['password'=>$password]);
            if($result){
                $response = [
                    'url' => url('admin/dashboard'),
                    'message' => trans('responses.setting.change_password'),
                    'delayTime' => 2000
                ];
                return response($this->getSuccessResponse($response));
            }else{
                return response($this->getErrorResponse(trans('responses.error')));
            }
        }else{
            return response($this->getErrorResponse(trans('responses.setting.wrong_current_password')));
        }
    }

    /**
     * @param $email, $token
     * @method sendResetPasswordMail
     * @purpose Send reset password link to admin
     */
    public function sendResetPasswordMail($email,$token){
        $mailData['name'] = $email;
        $mailData['link'] = url('reset_password/'.$token);
        $templateName = 'emails.forgot_password';
        $subject = 'Reset Your Password - Admin Vimory';
        $toEmail = $email;
        $toName  = $email;
        $mail = $this->sendCommonMail($templateName,$mailData,$toEmail,$toName,$subject);
        return $mail;
    }

    /**
     * @param   : $request
     * @response: response
     * @method  : getUsersList
     * @purpose : To get list of users
     */
    public function getUsersList(){
        $data = User::whereType(2)->whereTermsConditions(1)->get();
        return $data;
    }

    /**
     * @param   : $request
     * @response: response
     * @method  : changeUserStatus
     * @purpose : To change status of user
     */
    public function changeUserStatus($request){
        $status = 1;
        $id = Crypt::decrypt($request->id);
        $sts = $request->status;
        if($sts==1){
            $status = 0;
        }
        $result = User::whereId($id)->update(['status'=>$status]);
        if($result){
            $response = [
                'message' => trans('responses.user.status_changed'),
                'delayTime' => 2000,
                'status' => $status
            ];
            return response($this->getSuccessResponse($response));
        }else{
            return response($this->getErrorResponse(trans('responses.error')));
        }
    }

    /**
     * @param   : $request
     * @response: response
     * @method  : changeUserStatus
     * @purpose : To change status of user
     */
    public function deleteUser($request){
        $id = $this->decrypt($request->delete_id);
        $result = User::whereId($id)->delete();
        if($result){
            $response = [
                'url' => url('admin/users'),
                'message' => trans('responses.user.delete'),
                'delayTime' => 1500,
                'modelhide' => '#deleteModal'
            ];
            return response($this->getSuccessResponse($response));
        }else{
            return response($this->getErrorResponse(trans('responses.error')));
        }
    }

}
