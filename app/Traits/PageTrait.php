<?php

namespace App\Traits;

use App\Page;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Helpers\Helper;

trait PageTrait
{
    public $destinationPath;
    public $recordLimit = 10;
    /**
     * @param   : $request
     * @response: response
     * @method  : saveMusic
     * @purpose : Save music into Database
     */
    public function savePage($request){
        $post = $request->except(['_token']);
        $post['slug'] = Helper::create_slug($post['title']);
        $result = Page::insert($post);
        if($result){
            $response = [
                'url' => url('admin/pages'),
                'message' => trans('responses.pages.insert_success'),
                'delayTime' => 2000
            ];
            return response($this->getSuccessResponse($response));
        }else{
            return response($this->getErrorResponse(trans('responses.error')));
        }
    }

    /**
     * @param   : $request
     * @response: response
     * @method  : getMusicList
     * @purpose : To get list of music files
     */
    public function getPagesList(){
        $data = Page::paginate($this->recordLimit);
        return $data;
    }

    /**
     * @param   : $request
     * @response: response
     * @method  : getMusicById
     * @purpose : To get music record by id
     */
    public function getPageById($id){
        $id = Crypt::decrypt($id);
        $data = Page::whereId($id)->first();
        return $data;
    }

    /**
     * @param   : $request
     * @response: response
     * @method  : updateMusic
     * @purpose : Update music record into Database
     */
    public function updatePage($request){
        $id = $this->decrypt($request->record_id);
        $post = $request->except(['_token','record_id']);
        $post['slug'] = Helper::create_slug($post['title']);
        $update = Page::whereId($id)->update($post);
        if($update){
            $response = [
                'url' => url('admin/pages'),
                'message' => trans('responses.pages.update_success'),
                'delayTime' => 2000
            ];
            return response($this->getSuccessResponse($response));
        }else{
            return response($this->getErrorResponse(trans('responses.error')));
        }
    }

    /**
     * @param   : $request
     * @response: response
     * @method  : getMusicById
     * @purpose : To get music record by id
     */
    public function deletePage($request){
        $id = $this->decrypt($request->delete_id);
        $result = Page::whereId($id)->forceDelete();
        if($result){
            $response = [
                'url' => url('admin/pages'),
                'message' => trans('responses.pages.delete'),
                'delayTime' => 1500,
                'modelhide' => '#deleteModal'
            ];
            return response($this->getSuccessResponse($response));
        }else{
            return response($this->getErrorResponse(trans('responses.error')));
        }
    }
}
