<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Route;
use App\Admin\Seo;
use App\Admin\Webpage;
use App\Admin\Portfolio;
use App\Admin\Menu;
use App\Admin\Enquiry;
use App\Admin\Setting;
use App\Traits\HelperTrait;
use URL;

class WebpageController extends Controller
{

    use HelperTrait;

    public $data;
    public $menus;

    public function index(){
        return $this->loadRequestedURI('home');
    }

    public function loadRequestedURI($uri){
        $seo = Seo::where('page_url',$uri)->first();
        if($seo){
            $portfolio = Portfolio::where('status',1)->get();
            $set = Setting::where('id',1)->first();
            $widgetData['portfolio'] = $portfolio;
            $widgetData['set'] = $set;
            $sidebar =  view('site.widgets.quick_links')->with($widgetData)->render();
            $this->data['page'] = $seo;
            $this->data['sidebar'] = $sidebar;
            $this->data['setting'] = $set;
            $templateFile = 'webpage';
            if(isset($seo->menus->menu_webpage->template)){
                $templateFile = $seo->menus->menu_webpage->template;
            }
            $view = 'site.templates.'.$templateFile;
            return view($view)->with($this->data);
        }else{
            die('Page Not Found !!!');
        }
    }

    function submitEnquiryForm(Request $request){
        $mailData = $request->except(['_token']);;
        $templateName = 'emails.enquiry_form';
        $fromEmail = $mailData['email'];
        $fromName  = $mailData['name'];
        $subject = $mailData['subject'];
        $mail = $this->sendCommonMail($templateName,$mailData,$fromEmail,$fromName  ,$subject);
        $mailData['status'] = 'Pending';
        Enquiry::insert($mailData);
        return redirect()->back()->with('success', '<strong>Thanks!</strong> Query has been submitted. We will get back to you shortly.');   
    }
}
