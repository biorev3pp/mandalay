<?php
namespace App\Validators;

use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Validator;
use App\Validators\BaseValidator;
use Illuminate\Validation\Rule;

trait HomesValidator
{
    use BaseValidator;

    public $response;

    /**
     * @param   : Request $request
     * @return  : \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @method  : addMusicFileValidations
     * @purpose : Validation rule for add page
     */
    public function addHomeValidations(Request $request){
        try{
            $validations = array(
                'title'        => 'required',
                'area'         => 'required',
                'bedrooms'     => 'required',
                'bathrooms'    => 'required',
                'cost'         => 'required',
                'garage'       => 'required',
                'communities'  => 'required'
            );
            if(!isset($request->image_update) || $request->image_update==""){
                $validations['image'] = 'required|mimes:jpeg,jpg,png';                         
            }
            $validator = Validator::make($request->all(),$validations);
            $this->response = $this->validateData($validator);
        }catch(\Exception $e){
            $this->response = $e->getMessage();
        }
        return $this->response;
    }
}
