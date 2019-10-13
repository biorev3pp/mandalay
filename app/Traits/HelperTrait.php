<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;
use Mail;
use Str;

trait HelperTrait
{
    /**
     * @param $pageData
     * @return view
     * @throws \Throwable
     * @method makeBreadcrumb
     * @purpose Create breadcrumb and render its view
     */
    public function makeBreadcrumb($pageData){
        return view('includes.breadcrumb',$pageData)->render();
    }

    /**
     * @param $param
     * @return string
     * @method encrypt
     */
    public function encrypt($param){
        $data = Crypt::encrypt($param);
        return $data;
    }

    /**
     * @param $param
     * @return string
     * @method decrypt
     */
    public function decrypt($param){
        $data = Crypt::decrypt($param);
        return $data;
    }

    /**
     * @param string $subtitle
     * @return array|string
     * @method getBreadcrumb
     * @purpose To create breadcrumb on current page
     */
    public function getBreadcrumb($subtitle=''){
        $pageDetails['title'] = $this->title;
        $pageDetails['titleLink'] = $this->titleLink;
        if($subtitle!=''){
            $pageDetails['subtitle'] = $subtitle;
        }
        return $this->makeBreadcrumb($pageDetails);
    }

    /**
     * @param int $length
     * @return string
     * @method generateToken
     */
    public function generateToken($length = 100){
        return str_random($length);
    }

    /*
    * @method      : sendCommonMail
    * @purpose     : To send mail
    */
    public function sendCommonMail($templateName,$data,$fromEmail,$fromName,$subject){
        $response = Mail::send($templateName, ['data' => $data], function($message) use ($fromEmail,$fromName,$subject) {
            $message->from($fromEmail, $fromName);
            $message->to(config('mail.to.address'), config('mail.to.name'))->subject($subject);
        });
        return $response;
    }

    /*
     * @method       : create_slug
     * @created_date : 11-09-2019 (dd-mm-yyyy)
     * @purpose      : to create url slug from string
     */
    public static function create_slug($string)
    {
        $string = preg_replace('/[^a-zA-Z0-9_ -]/s','',$string);
        return Str::kebab($string);
    }
}
