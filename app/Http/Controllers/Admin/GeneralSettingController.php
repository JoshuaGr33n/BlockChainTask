<?php

namespace App\Http\Controllers\Admin;

use App\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GeneralSetting;
use Illuminate\Support\Facades\Validator;
use Image;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $general_setting = GeneralSetting::first();
        $page_title = 'General Settings';
        return view('admin.setting.general_setting', compact('page_title', 'general_setting'));
    }

    public function update(Request $request)
    {

        $validation_rule = [

        ];

        $custom_attribute = [

        ];


           $basic = GeneralSetting::first();

        if($basic->demo == 1){
        $notify[] = ['error', 'You are not allowed to edit our demo. Please buy the script'];
        return back()->withNotify($notify);
        }

        $validator = Validator::make($request->all(), $validation_rule, [], $custom_attribute);
        $validator->validate();
        $general_setting = GeneralSetting::first();
        $request->merge(['ev' => isset($request->ev) ? 1 : 0]);
        $request->merge(['en' => isset($request->en) ? 1 : 0]);
        $request->merge(['sv' => isset($request->sv) ? 1 : 0]);
        $request->merge(['sn' => isset($request->sn) ? 1 : 0]);
        $request->merge(['reg' => isset($request->reg) ? 1 : 0]);
        $request->merge(['deposit_commission' => isset($request->deposit_commission) ? 1 : 0]);
        $request->merge(['invest_commission' => isset($request->invest_commission) ? 1 : 0]);
        $request->merge(['invest_return_commission' => isset($request->invest_return_commission) ? 1 : 0]);

        $general_setting->update($request->only(['sitename', 'cur_text', 'cur_sym', 'ev', 'en', 'sv', 'sn', 'reg', 'alert', 'bclr', 'sclr','deposit_commission','invest_commission','invest_return_commission','active_template']));
        $notify[] = ['success', 'Genereal Updated Successfully'];
        return back()->withNotify($notify);
    }

    public function logoIcon()
    {
        $page_title = 'Logo & Icon';
        return view('admin.setting.logo_icon', compact('page_title'));
    }

    public function logoIconUpdate(Request $request)
    {
          $basic = GeneralSetting::first();

        if($basic->demo == 1){
        $notify[] = ['error', 'You are not allowed to edit our demo. Please buy the script'];
        return back()->withNotify($notify);
        }
        $request->validate([
            'logo' => 'image|mimes:jpg,jpeg,png',
            'favicon' => 'image|mimes:png,jpeg,jpg',
        ]);

        if ($request->hasFile('logo')) {

         $image = $request->file('logo');
            $filename = 'logo.png';
            $location = 'assets/images/logoIcon/' . $filename;

            $path = './assets/images/logoIcon/';
            $link = $path . $filename;
            if (file_exists($link)) {
                @unlink($link);
            }
            Image::make($image)->save($location);



        }



        if ($request->hasFile('favicon')) {
          $image = $request->file('favicon');

            $filename = 'favicon.png';
            $location = 'assets/images/logoIcon/' . $filename;

            $path = './assets/images/logoIcon/';
            $link = $path . $filename;
            if (file_exists($link)) {
                @unlink($link);
            }
            Image::make($image)->save($location);
        }

        $notify[] = ['success', 'Logo Icons has been updated.'];
        return back()->withNotify($notify);
    }

    public function socialLogin()
    {
        $page_title = 'Social Login Setting';
        $general_setting = GeneralSetting::first(['social_login']);
        $social_login = Frontend::where('key', 'gauth')->orWhere('key', 'fauth')->get();
        return view('admin.setting.social_login_setting', compact('page_title', 'general_setting', 'social_login'));
    }

    public function socialLoginUpdate(Request $request)
    {
        $validation_rule = [
            'gid' => 'required_with:social_login',
            'gsecret' => 'required_with:social_login',
            'fid' => 'required_with:social_login',
            'fsecret' => 'required_with:social_login',
        ];

        $custom_attribute = [
            'gid' => 'Google client id',
            'gsecret' => 'Google client secret',
            'fid' => 'Facebook client id',
            'fsecret' => 'Facebook client secret',
        ];

        $custom_message = ['*.required_with' => ':attribute is required for social login'];

        $validator = Validator::make($request->all(), $validation_rule, $custom_message, $custom_attribute);
        $validator->validate();

        $gid = '';
        $gsecret = '';
        $fid = '';
        $fsecret = '';
        if ($request->social_login) {
            $gid = $request->gid;
            $gsecret = $request->gsecret;
            $fid = $request->fid;
            $fsecret = $request->fsecret;
        }

        Frontend::updateOrCreate(

            ['key' => 'gauth'],
            ['value' => [
                'id' => $gid,
                'secret' => $gsecret,
            ]]

        );
        Frontend::updateOrCreate(

            ['key' => 'fauth'],
            ['value' => [
                'id' => $fid,
                'secret' => $fsecret,
            ]]

        );

        $general_setting = GeneralSetting::first();
        $request->merge(['social_login' => isset($request->social_login) ? 1 : 0]);
        $general_setting->update($request->only(['social_login']));

        $notify[] = ['success', 'Social Login Setting has been updated.'];
        return back()->withNotify($notify);
    }
}
