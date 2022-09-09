<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Language;
use App\Rules\FileTypeValidate;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Image;

class LanguageController extends Controller
{
    public function langManage($lang = false)
    {
        $page_title = 'Language Manager';
        $empty_message = 'No language has been added.';
        $languages = Language::orderByDesc('is_default')->paginate(config('constants.table.default'));
        return view('admin.language.lang', compact('page_title', 'empty_message', 'languages'));
    }

    public function langStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:languages',
            'text_align' => 'required|in:0,1',
            'icon' => ['nullable', 'image', new FileTypeValidate(['png'])]
        ]);

        if (strtolower($request->code) == 'en') {
            $notify[] = ['error', 'Reserved Language'];
            return back()->with($notify);
        }

        $data = file_get_contents(resource_path('lang/') . 'default.json');
        $json_file = strtolower($request->code) . '.json';
        $path = resource_path('lang/') . $json_file;

        File::put($path, $data);

        $filename = null;
        if ($request->hasFile('icon')) {
            try {
                $path = config('constants.language.path');
                $size = config('constants.language.size');
                $filename = upload_image($request->icon, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload icon.'];
                return back()->withNotify($notify);
            }
        }

        if ($request->is_default) {
            Language::where('is_default', 1)->update([
                'is_default' => 0
            ]);
        }
        Language::create([
            'name' => $request->name,
            'code' => strtolower($request->code),
            'text_align' => $request->text_align,
            'icon' => $filename,
            'is_default' => $request->is_default ? 1 : 0,
        ]);

        $notify[] = ['success', 'Create Successfully'];
        return back()->withNotify($notify);
    }

    public function langUpdatepp(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'text_align' => 'required|in:0,1',
            'icon' => ['nullable', 'image', new FileTypeValidate(['png'])]
        ]);

        $la = Language::findOrFail($id);

        $filename = $la->icon;
        if ($request->hasFile('icon')) {
            try {
                $path = config('constants.language.path');
                $size = config('constants.language.size');
                $filename = upload_image($request->icon, $path, $size, $la->icon);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload icon.'];
                return back()->withNotify($notify);
            }
        }

        if ($request->is_default) {
            Language::where('is_default', 1)->update([
                'is_default' => 0
            ]);
        }

        $la->update([
            'name' => $request->name,
            'text_align' => $request->text_align,
            'icon' => $filename,
            'is_default' => $request->is_default ? 1 : 0,
        ]);

        $notify[] = ['success', 'Update Successfully'];
        return back()->withNotify($notify);
    }

    public function langDel($id)
    {
        $la = Language::find($id);
        remove_file(config('constants.language.path') . '/' . $la->icon);
        remove_file(resource_path('lang/') . $la->code . '.json');
        $la->delete();
        $notify[] = ['success', 'Delete Successfully'];
        return back()->withNotify($notify);
    }

    public function langEdit($id)
    {
        $la = Language::find($id);
        $page_title = "Update " . $la->name . " Keywords";
        $json = file_get_contents(resource_path('lang/') . $la->code . '.json');
        $list_lang = Language::all();

        if (empty($json)) {
            $notify[] = ['error', 'File Not Found.'];
            return back()->with($notify);
        }

        return view('admin.language.edit_lang', compact('page_title', 'json', 'la', 'list_lang'));
    }

    public function langUpdate(Request $request, $id)
    {
        $lang = Language::find($id);
        $content = json_encode($request->keys);

        if ($content === 'null') {
            $notify[] = ['error', 'At Least One Field Should Be Fill-up'];
            return back()->withNotify($notify);
        }

        file_put_contents(resource_path('lang/') . $lang->code . '.json', $content);

        $notify[] = ['success', 'Update Successfully'];
        return back()->withNotify($notify);
    }

    public function langImport(Request $request)
    {
        $lang = Language::find($request->code);
        $json = file_get_contents(resource_path('lang/') . $lang->code . '.json');
        return $json;
    }
}
