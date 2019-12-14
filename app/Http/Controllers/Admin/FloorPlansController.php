<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\FloorPlans;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\Auth;

class FloorPlansController extends Controller
{
    use HelperTrait;
    public $title;
    public $data;

    public function __construct(){
        $this->title = 'Floor Plans';
        $this->data['page_title'] = $this->title;
        $this->data['statusArray'] = $this->getStatusArray();
    }

    public function index(){
        $result = FloorPlans::where('user_id', Auth::user()->id)->get();
        $this->data['data'] = $result;
        return view('admin.floor_plans.index')->with($this->data);
    }
}
