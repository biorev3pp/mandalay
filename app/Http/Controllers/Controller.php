<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\ResponseTrait;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ResponseTrait;

    /** 
     * @method getStatusArray
     * @purpose Get array os status values
    */
    public function getStatusArray(){
        return array('1'=>'Active','0'=>'Inactive');
    }

    

    // function for debugging
    public function print($data){
        echo '<pre>';
        print_r($data);
        die;
    } 

}
