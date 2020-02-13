<?php
namespace App\Validators;

use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Validator;
use App\Validators\BaseValidator;
use Illuminate\Validation\Rule;

trait MenuValidator
{
    use BaseValidator;

    public $response;

    /**
     * @param   : Request $request
     * @return  : \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @method  : addMusicFileValidations
     * @purpose : Validation rule for add page
     */
    public function addMenuValidations(Request $request){
        try{
            if($request->record_id){
                $id = $this->decrypt($request->record_id);
                $validator = Validator::make($request->all(), [
                    'menu_title' => Rule::unique('menus')->where(function ($query) use($id){
                        return $query->where('id','!=',$id);
                    }),
                ]);
            }else{
                $validator = Validator::make($request->all(), [
                    'menu_title' => 'required',
                    'linked_page_id' => 'required',
                ]);
            }
            $this->response = $this->validateData($validator);
        }catch(\Exception $e){
            $this->response = $e->getMessage();
        }
        return $this->response; 
    }
}
