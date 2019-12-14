<?php
namespace App\Validators;

use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Validator;
use App\Validators\BaseValidator;
use Illuminate\Validation\Rule;

trait UserRolesValidator
{
    use BaseValidator;

    public $response;

    /**
     * @param   : Request $request
     * @return  : \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @method  : addMusicFileValidations
     * @purpose : Validation rule for add page
     */
    public function addUserValidations(Request $request){
        try{
            $validations = array(
                'role'        => 'required',
            );
            $validator = Validator::make($request->all(),$validations);
            $this->response = $this->validateData($validator);
        }catch(\Exception $e){
            $this->response = $e->getMessage();
        }
        return $this->response;
    }
}
