<?php

namespace App\Http\Controllers\Admin;

use App\ContactTopic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactTopicController extends Controller
{

    public function index()
    {
        $data['page_title'] = "Manage Ticket Type";
        return view('admin.support.contact-topic', $data);
    }

    public function getTopic()
    {
        $items =  ContactTopic::all();
        return $items;
    }

    public function storeTopic(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $excp = $request->except('_token');
        $result = ContactTopic::create($excp);
        if ($result) {
            return [
                'status' => 'success',
                'message'=>'Insert Successfully',
                'data'=>$result
            ];
        } else {
            return [
                'status' => 'error',
                'message'=>'failed!!!',
                'data'=>[]
            ];
        }
    }

    public function updateTopic(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric',
            'name' => 'required|max:191',
        ]);
        $in['name'] =  $request->name;
        $result =  ContactTopic::findOrFail($request->id)->update($in);
        if($result){
            return [
                'status' => 'success',
                'message' => 'Update Successfully',
                'data' => $result
            ];
        }else{
            return [
                'status' => 'error',
                'message' => 'Updating Failed',
                'data' => []
            ];
        }
    }

    public function destroyTopic(Request $request)
    {

        $this->validate($request, [
            'id' => 'required',
        ]);

        $result =  ContactTopic::destroy($request->id);
        if($result){
            return [
                'status' => 'success',
                'message' => 'Delete Successfully',
                'data' => []
            ];
        }else{
            return [
                'status' => 'error',
                'message' => 'Failed!!',
                'data' => []
            ];
        }
    }

}
