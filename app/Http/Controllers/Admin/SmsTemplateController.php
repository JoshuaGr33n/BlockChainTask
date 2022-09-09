<?php

namespace App\Http\Controllers\Admin;

use App\GeneralSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SmsTemplate;

class SmsTemplateController extends Controller
{
    public function index()
    {
        $page_title = 'SMS Templates';
        $empty_message = 'No templates available';
        $sms_templates = SmsTemplate::paginate(config('constants.table.default'));
        return view('admin.sms_template.index', compact('page_title', 'empty_message', 'sms_templates'));
    }

    public function edit($id)
    {
        $sms_template = SmsTemplate::findOrFail($id);
        $page_title = $sms_template->name;
        return view('admin.sms_template.edit', compact('page_title', 'sms_template'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sms_body' => 'required',
        ]);

        $sms_template = SmsTemplate::findOrFail($id);

        $sms_template->update([
            'sms_body' => $request->sms_body,
            'sms_status' => $request->sms_status ? 1 : 0,
        ]);

        $notify[] = ['success', $sms_template->name . ' template has been updated'];
        return back()->withNotify($notify);
    }


    public function smsSetting()
    {
        $page_title = 'SMS Template';

        $general_setting = GeneralSetting::first('smsapi');

        return view('admin.sms_template.sms_setting', compact('page_title', 'general_setting'));
    }

    public function smsSettingUpdate(Request $request)
    {
        $request->validate([
            'smsapi' => 'required',
        ]);

        $general_setting = GeneralSetting::first();

        $general_setting->update([
            'smsapi' => $request->smsapi,
        ]);

        $notify[] = ['success', 'SMS Template has been updated'];
        return back()->withNotify($notify);
    }

    public function sendTestSMS(Request $request)
    {
        $request->validate(['mobile' => 'required']);
        $general = GeneralSetting::first(['sn', 'smsapi']);
        if ($general->sn == 1) {
            $message = shortcode_replacer("{{number}}", $request->mobile, $general->smsapi);
            $message = shortcode_replacer("{{message}}", 'This is a test sms', $message);
            $result = @file_get_contents($message);
        }

        $notify[] = ['success', 'You sould receive a test sms at ' . $request->mobile . ' shortly.'];
        return back()->withNotify($notify);
    }
}
