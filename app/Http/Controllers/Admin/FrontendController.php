<?php

namespace App\Http\Controllers\Admin;

use App\Frontend;
use App\GeneralSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\FileTypeValidate;
use Image;
use File;

class FrontendController extends Controller
{
    public function blogIndex()
    {
        $page_title = 'Blog Post';
        $empty_message = 'No blog post yet.';
        $blog = Frontend::where('data_keys', 'blog.caption')->latest()->firstOrFail();
        $blog_posts = Frontend::where('data_keys', 'blog.post')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.blog.index', compact('page_title', 'empty_message', 'blog', 'blog_posts'));
    }

    public function blogNew()
    {
        $page_title = 'New Post';
        return view('admin.frontend.blog.new', compact('page_title'));
    }

    public function blogEdit($id)
    {
        $page_title = 'Edit Post';
        $post = Frontend::findOrFail($id);
        return view('admin.frontend.blog.edit', compact('page_title', 'post'));
    }

    public function seoEdit()
    {
        $page_title = 'SEO Configuration';
        $seo = Frontend::where('data_keys', 'seo')->first();
        if (!$seo) {
            $notify[] = ['error', 'Something went wrong or not functioning properly, contact developer.'];
            return back()->withNotify($notify);
        }
        return view('admin.frontend.seo.edit', compact('page_title', 'seo'));
    }

    public function testimonialIndex()
    {
        $page_title = 'Testimonials';
        $empty_message = 'No testimonials';

        $caption = Frontend::where('data_keys', 'testimonial.caption')->latest()->first();
        $testimonials = Frontend::where('data_keys', 'testimonial')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.testimonial.index', compact('page_title', 'empty_message', 'testimonials', 'caption'));
    }

    public function testimonialNew()
    {
        $page_title = 'New Testimonial';
        return view('admin.frontend.testimonial.new', compact('page_title'));
    }

    public function testimonialEdit($id)
    {
        $page_title = 'Edit Testimonial';
        $testi = Frontend::findOrFail($id);
        return view('admin.frontend.testimonial.edit', compact('page_title', 'testi'));
    }

    public function socialIndex()
    {
        $page_title = 'Social Icons';
        $empty_message = 'No social icons';
        $socials = Frontend::where('data_keys', 'social.item')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.social.index', compact('page_title', 'empty_message', 'socials'));
    }

    public function store(Request $request)
    {
    $basic = GeneralSetting::first();

        if($basic->demo == 1){
        $notify[] = ['error', 'You are not allowed to edit our demo. Please buy the script'];
        return back()->withNotify($notify);
        }
        $validation_rule = ['key' => 'required'];
        foreach ($request->except('_token') as $input_field => $val) {
            if ($input_field == 'has_image') {
                $validation_rule['image_input'] = ['required', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])];
                continue;
            }
            $validation_rule[$input_field] = 'required';
        }
        $request->validate($validation_rule, [], ['image_input' => 'image']);

        if ($request->hasFile('image_input')) {
            try {
                $request->merge(['image' => $this->store_image($request->key, $request->image_input)]);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload the Image.'];
                return back()->withNotify($notify);
            }
        }

        Frontend::create([
            'data_keys' => $request->key,
            'data_values' => $request->except('_token', 'key', 'image_input'),
        ]);

        $notify[] = ['success', 'Content has been added.'];
        return back()->withNotify($notify);
    }

    public function update(Request $request, $id)
    {
    $basic = GeneralSetting::first();

        if($basic->demo == 1){
        $notify[] = ['error', 'You are not allowed to edit our demo. Please buy the script'];
        return back()->withNotify($notify);
        }
        $validation_rule = [];
        foreach ($request->except('_token', 'video') as $input_field => $val) {
            if ($input_field == 'image_input' && !isset($validation_rule['image_input'])) {
                $validation_rule['image_input'] = ['nullable', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])];
                continue;
            }

            $validation_rule[$input_field] = 'required';
        }

        $request->validate($validation_rule, [], ['image_input' => 'image']);

        $content = Frontend::findOrFail($request->id);
        if ($request->hasFile('image_input')) {
            try {
                $request->merge(['image' => $this->store_image($content->data_keys, $request->image_input, $content->data_values->image
                )]);
            } catch (\Exception $exp) {
                dd($exp);
                $notify[] = ['error', 'Could not upload the Image.'];
                return back()->withNotify($notify);
            }
        } else if (isset($content->data_values->image)) {
            $request->merge(['image' => $content->data_values->image]);
        }

        $content->update(['data_values' => $request->except('_token', 'image_input', 'key')]);
        $notify[] = ['success', 'Content has been updated.'];
        return back()->withNotify($notify);
    }

    public function remove(Request $request)
    {
       $basic = GeneralSetting::first();

        if($basic->demo == 1){
        $notify[] = ['error', 'You are not allowed to edit our demo. Please buy the script'];
        return back()->withNotify($notify);
        }
        $request->validate(['id' => 'required']);
        $frontend = Frontend::findOrFail($request->id);
        if (isset($frontend->data_values->image)) {
            remove_file(config('constants.frontend.' . $frontend->data_keys . '.path') . '/' . $frontend->data_values->image);
        }
        $frontend->delete();
        $notify[] = ['success', 'Content has been removed.'];
        return back()->withNotify($notify);
    }

    protected function store_image($key, $image, $old_image = null)
    {
        $path = config('constants.frontend.' . $key . '.path');
        $size = config('constants.frontend.' . $key . '.size');
        $thumb = config('constants.frontend.' . $key . '.thumb');
        return upload_image($image, $path, $size, $old_image, $thumb);
    }

    // FAQ Management

    public function faqIndex()
    {
        $page_title = 'FAQ';
        $empty_message = 'No FAQ create yet.';
        $blog_posts = Frontend::where('data_keys', 'faq')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.faq.index', compact('page_title', 'empty_message', 'blog_posts'));
    }

    public function faqNew()
    {
        $page_title = 'Add New FAQ';
        return view('admin.frontend.faq.new', compact('page_title'));
    }

    public function faqEdit($id)
    {
        $page_title = 'Edit FAQ';
        $post = Frontend::where('id', $id)->where('data_keys', 'faq')->firstOrFail();
        return view('admin.frontend.faq.edit', compact('page_title', 'post'));
    }

    // Rule
    public function ruleIndex()
    {
        $page_title = 'All Rule';
        $empty_message = 'No Rule create yet.';
        $blog_posts = Frontend::where('data_keys', 'rules')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.rules.index', compact('page_title', 'empty_message', 'blog_posts'));
    }

    public function ruleNew()
    {
        $page_title = 'Add New Rule';
        return view('admin.frontend.rules.new', compact('page_title'));
    }

    public function ruleEdit($id)
    {
        $page_title = 'Edit Rule';
        $post = Frontend::where('id', $id)->where('data_keys', 'rules')->firstOrFail();
        return view('admin.frontend.rules.edit', compact('page_title', 'post'));
    }

    // Company Policy
    public function companyPolicy()
    {
        $page_title = 'Company Policy';
        $empty_message = 'No Policy yet.';
        $blog_posts = Frontend::where('data_keys', 'company_policy')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.policy.index', compact('page_title', 'empty_message', 'blog_posts'));
    }

    public function companyPolicyNew()
    {
        $page_title = 'Add New Policy';
        return view('admin.frontend.policy.new', compact('page_title'));
    }

    public function companyPolicyEdit($id)
    {
        $page_title = 'Edit Policy';
        $post = Frontend::findOrFail($id);
        return view('admin.frontend.policy.edit', compact('page_title', 'post'));
    }


    // Manage About

    public function sectionAbout()
    {
        $basic = GeneralSetting::first();
        $page_title = 'Manage About';
        if ($basic->active_template == 'basic') {
            $post = Frontend::where('data_keys', 'about')->firstOrFail();
            return view('admin.frontend.section.about-basic', compact('page_title', 'post'));
        } else if ($basic->active_template == 'minimul') {
            $post = Frontend::where('data_keys', 'about.minimul')->firstOrFail();
            return view('admin.frontend.section.about', compact('page_title', 'post'));
        }
        abort(404);

    }

    public function sectionAboutUpdate(Request $request, $id)
    {

    $basic = GeneralSetting::first();

        if($basic->demo == 1){
        $notify[] = ['error', 'You are not allowed to edit our demo. Please buy the script'];
        return back()->withNotify($notify);
        }
        $basic = GeneralSetting::first();


            $data = Frontend::where('id', $id)->where('data_keys', 'about.minimul')->firstOrFail();
            $in['title'] = $request->title;
            $in['details'] = $request->details;
            $in['commission_title'] = $request->commission_title;
            $in['commission_details'] = $request->commission_details;
            $in['commission_link'] = $request->commission_link;
            $in['investor_title'] = $request->investor_title;
            $in['investor_details'] = $request->investor_details;
            $in['statistics_title'] = $request->statistics_title;
            $in['statistics_details'] = $request->statistics_details;


            if ($request->hasFile('image')) {
                @unlink('assets/images/frontend/' . @$data->data_values->image);
                $image = $request->file('image');
                $filename = 'about-minimul.' . $image->getClientOriginalExtension();
                $location = 'assets/images/frontend/' . $filename;
                Image::make($image)->save($location);
                $in['about'] = $filename;
            } else {
                $in['about'] = @$data->data_values->image;
            }


            $data->data_values = $in;
            $data->save();

        $notify[] = ['success', 'Update Successfully.'];
        return back()->withNotify($notify);
    }

    public function sectionHomeContent()
    {
        $page_title = 'Home Content';
        $basic = GeneralSetting::first();


            $post = Frontend::where('data_keys', 'homecontent2')->firstOrFail();
            return view('admin.frontend.section.home', compact('page_title', 'post'));


    }

    public function sectionHomeContentUpdate(Request $request, $id)
    {

        $basic = GeneralSetting::first();

        if($basic->demo == 1){
        $notify[] = ['error', 'You are not allowed to edit our demo. Please buy the script'];
        return back()->withNotify($notify);
        }


            $request->validate([
                'title' => 'required',
                'details' => 'required',
                'image' => ' mimes:jpeg,jpg,png| max:2048'
            ]);

            $data = Frontend::where('id', $id)->where('data_keys', 'homecontent2')->firstOrFail();

            $in['title'] = $request->title;
             $in['details'] = $request->details;
            $in['plan_title'] = $request->plan_title;
            $in['plan_sub_title'] = $request->plan_sub_title;
            $in['invest_title'] = $request->invest_title;
            $in['invest_sub_title'] = $request->invest_sub_title;
            $in['profit_title'] = $request->profit_title;
            $in['profit_sub_title'] = $request->profit_sub_title;
            $in['trx_title'] = $request->trx_title;
            $in['trx_sub_title'] = $request->trx_sub_title;


            if ($request->hasFile('image')) {
                @unlink('assets/images/frontend/' . @$data->data_values->image);
                $image = $request->file('image');
                $filename = 'banner01.'. $image->getClientOriginalExtension();;
                $location = 'assets/images/frontend/' . $filename;
                Image::make($image)->save($location);
                $in['image'] = $filename;
            } else {
                $in['image'] = @$data->data_values->image;
            }

            if ($request->hasFile('coin_image')) {
                @unlink('assets/images/frontend/' . @$data->data_values->coin_image);
                $image = $request->file('coin_image');
                $filename = 'banner-coin.'. $image->getClientOriginalExtension();;
                $location = 'assets/images/frontend/' . $filename;
                Image::make($image)->save($location);
                $in['coin_image'] = $filename;
            } else {
                $in['coin_image'] = @$data->data_values->coin_image;
            }

            $data->data_values = $in;
            $data->save();


        $notify[] = ['success', 'Update Successfully.'];
        return back()->withNotify($notify);
    }

    public function sectionContact()
    {
        $page_title = 'Manage Contact';
        $post = Frontend::where('data_keys', 'contact')->firstOrFail();

        return view('admin.frontend.section.contact', compact('page_title', 'post'));
    }


    public function servicesIndex()
    {
        $page_title = 'Services';
        $empty_message = 'No Data Found';
        $howItWorks = Frontend::where('data_keys', 'services')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.services.index', compact('page_title', 'empty_message', 'howItWorks'));
    }

    public function servicesNew()
    {
        $page_title = 'Add New Services';
        return view('admin.frontend.services.new', compact('page_title'));
    }

    public function servicesEdit($id)
    {
        $page_title = 'Edit Services';
        $testi = Frontend::where('id', $id)->where('data_keys', 'services')->firstOrFail();
        return view('admin.frontend.services.edit', compact('page_title', 'testi'));
    }


    public function profitIndex()
    {
        $page_title = 'HOW TO GET PROFIT';
        $empty_message = 'No Data Found';
        $blog = Frontend::where('data_keys', 'profit.caption')->latest()->first();
        $howItWorks = Frontend::where('data_keys', 'profit')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.profit.index', compact('page_title', 'empty_message', 'howItWorks','blog'));
    }

    public function profitNew()
    {
        $page_title = 'Add New';
        return view('admin.frontend.profit.new', compact('page_title'));
    }

    public function profitEdit($id = null)
    {
        $page_title = 'Edit Profit';
        $testi = Frontend::where('id', $id)->where('data_keys', 'profit')->firstOrFail();
        return view('admin.frontend.profit.edit', compact('page_title', 'testi'));
    }


    public function featureIndex()
    {
        $page_title = 'Our Feature';
        $empty_message = 'No Data Found';
        $blog = Frontend::where('data_keys', 'feature.caption')->latest()->first();
        $howItWorks = Frontend::where('data_keys', 'feature')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.feature.index', compact('page_title', 'empty_message', 'howItWorks','blog'));
    }

    public function featureNew()
    {
        $page_title = 'Add New';
        return view('admin.frontend.feature.new', compact('page_title'));
    }

    public function featureEdit($id = null)
    {
        $page_title = 'Edit Feature';
        $testi = Frontend::where('id', $id)->where('data_keys', 'feature')->firstOrFail();
        return view('admin.frontend.feature.edit', compact('page_title', 'testi'));
    }


    public function logoIcon()
    {
        $page_title = 'Breadcrumb Image & Icon';
        return view('admin.frontend.logo_icon', compact('page_title'));
    }

    public function logoIconUpdate(Request $request)
    {
         if($basic->demo == 1){
        $notify[] = ['error', 'You are not allowed to edit our demo. Please buy the script'];
        return back()->withNotify($notify);
        }


        if ($request->hasFile('page_header')) {
            $image = $request->file('page_header');
            $filename = 'page-header-01.png';
            $location = 'assets/images/frontend/breadcrumb/' . $filename;
            Image::make($image)->save($location);
        }

        if ($request->hasFile('coin')) {
            $image = $request->file('coin');
            $filename = 'coin.png';
            $location = 'assets/images/frontend/breadcrumb/' . $filename;
            Image::make($image)->save($location);
        }

        if ($request->hasFile('tree1')) {
            $image = $request->file('tree1');
            $filename = 'tree1.png';
            $location = 'assets/images/frontend/footer/' . $filename;
            Image::make($image)->save($location);
        }

        if ($request->hasFile('coin_icon')) {
            $image = $request->file('coin_icon');
            $filename = 'coin1.png';
            $location = 'assets/images/frontend/footer/' . $filename;
            Image::make($image)->save($location);
        }



        if ($request->hasFile('tree2')) {
            $image = $request->file('tree2');
            $filename = 'tree2.png';
            $location = 'assets/images/frontend/footer/' . $filename;
            Image::make($image)->save($location);
        }


        $notify[] = ['success', 'Updated Successfully.'];
        return back()->withNotify($notify);
    }



}
