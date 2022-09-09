<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Currency;
use App\GeneralSetting;
use App\Http\Controllers\Controller;
use App\SupportAttachment;
use App\SupportMessage;
use App\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function currency()
    {
        $page_title = 'Manage Currency';
        $empty_message = 'No Currency Found.';
        $events = Currency::latest()->paginate(config('constants.table.default'));
        return view('admin.currency.list', compact('page_title', 'empty_message', 'events'));
    }

    public function updateRateApiKey(Request $request)
    {
        $basic = GeneralSetting::first();
        $basic->currency_api_key = trim($request->currency_api_key);
        $basic->save();
        $notify[] = ['success', 'Saved Successfully.'];
        return back()->withNotify($notify);
    }

    public function updateCurrency(Request $request)
    {
        $this->validate($request,[
                'rate' => 'required|numeric|min:0',
                'code' => 'required|min:3|max:3',
            ],[
                'rate.required' => 'Currency  rate must not be empty!!',
                'rate.numeric' => 'Currency  rate must  be positive number!!',
                'rate.min' => 'Currency  rate must  be positive number!!'
            ]);

        $macCount = Currency::where('name', $request->name)->where('id', '!=', $request->id)->count();
        if ($macCount > 0) {
            $notify[] = ['error', 'This one Already Exist.'];
            return back()->withNotify($notify)->withInput();
        }


        if ($request->id == 0) {
            $data['name'] = $request->name;
            $data['code'] = strtoupper(trim(str_replace(" ","",$request->code)));
            $data['rate'] = formatter_money($request->rate);
            $data['status'] = $request->status;
            $res = Currency::create($data);

            if ($res) {
                $notify[] = ['success', 'Saved Successfully'];
                return back()->withNotify($notify)->withInput();
            } else {
                $notify[] = ['error', 'Problem With Store Data'];
                return back()->withNotify($notify)->withInput();
            }
        } else {
            $mac = Currency::findOrFail($request->id);
            $mac['name'] = $request->name;
            $mac['code'] = strtoupper(trim(str_replace(" ","",$request->code)));
            $mac['rate'] = formatter_money($request->rate);
            $mac['status'] = $request->status;
            $res = $mac->save();

            if ($res) {
                $notify[] = ['success', 'Updated Successfully'];
                return back()->withNotify($notify)->withInput();
            } else {
                $notify[] = ['error', 'Problem With Store Data'];
                return back()->withNotify($notify)->withInput();
            }
        }
    }


    public function staff()
    {

        $page_title = 'Manage Staff';
        $empty_message = 'No Data Found.';
        $events = Admin::paginate(config('constants.table.default'));
        return view('admin.staff.list', compact('page_title', 'empty_message', 'events'));

    }

    public function storeStaff(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'username' => 'required|alpha_dash|unique:admins,username',
            'email' => 'required|email|max:191|unique:admins,email',
            'password' => 'nullable|min:5',
            'status' => 'required'
        ]);

        $item = new Admin();
        $item->name = $request->name;
        $item->username = $request->username;
        $item->email = $request->email;
        $item->mobile = $request->mobile;
        if(isset($request->password)){
            $item->password = Hash::make($request->password);
        }
        $item->access = (isset($request->access)) ? json_encode($request->access) : json_encode(array("0"));
        $item->status = $request->status;
        $item->save();

        $notify[] = ['success', 'Added Successfully.'];
        return back()->withNotify($notify);
    }


    public function updateStaff(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'username' => 'required|alpha_dash|unique:admins,username,'.$id,
            'email' => 'required|email|max:191|unique:admins,email,'.$id,
            'password' => 'nullable|min:5',
            'status' => 'required'
        ]);

        $item = Admin::findOrFail($id);
        $item->name = $request->name;
        $item->username = $request->username;
        $item->email = $request->email;
        $item->mobile = $request->mobile;
        if(isset($request->password)){
            $item->password = Hash::make($request->password);
        }

        $item->access = (isset($request->access)) ? json_encode($request->access) : json_encode(array("0"));
        $item->status = $request->status;
        $item->save();

        $notify[] = ['success', 'Updated Successfully.'];
        return back()->withNotify($notify);

    }



    public function supportTicket()
    {
        $page_title = 'Support Tickets';
        $empty_message = 'No Data found.';
        $items = SupportTicket::orderBy('id', 'DESC')->paginate(config('constants.table.default'));
        return view('admin.support.tickets', compact('items', 'page_title','empty_message'));
    }
    public function openSupportTicket()
    {
        $page_title = 'Open Tickets';
        $empty_message = 'No Data found.';
        $items = SupportTicket::orderBy('id', 'DESC')->whereIN('status', [0])->paginate(config('constants.table.default'));
        return view('admin.support.tickets', compact('items', 'page_title','empty_message'));
    }

    public function pendingSupportTicket()
    {
        $page_title = 'Pending Tickets';
        $empty_message = 'No Data found.';
        $items = SupportTicket::whereIN('status', [0, 2])->orderBy('id', 'DESC')->paginate(config('constants.table.default'));
        return view('admin.support.pendingTickets', compact('items', 'page_title','empty_message'));
    }

    public function closedSupportTicket()
    {
        $empty_message = 'No Data found.';
        $page_title = 'Closed Tickets';
        $items = SupportTicket::whereIN('status', [3])->orderBy('id', 'DESC')->paginate(config('constants.table.default'));
        return view('admin.support.pendingTickets', compact('items', 'page_title','empty_message'));
    }



    public function ticketReply($id)
    {
        $ticket = SupportTicket::with('user')->where('id',$id)->firstOrFail();
        $page_title = 'Support Tickets';
        $messages = SupportMessage::with('ticket')->where('supportticket_id', $ticket->id)->latest()->get();
        return view('admin.support.reply', compact('ticket', 'messages', 'page_title'));
    }

    public function ticketReplySend(Request $request, $id)
    {

        $ticket = SupportTicket::with('user')->where('id',$id)->firstOrFail();


        $message = new SupportMessage();
        if ($request->replayTicket == 1) {

            $imgs = $request->file('attachments');
            $allowedExts = array('jpg', 'png', 'jpeg', 'pdf');

            $this->validate($request, [
                'attachments' => [
                    'max:4096',
                    function ($attribute, $value, $fail) use ($imgs, $allowedExts) {
                        foreach ($imgs as $img) {
                            $ext = strtolower($img->getClientOriginalExtension());
                            if (($img->getClientSize() / 1000000) > 2) {
                                return $fail("Images MAX  2MB ALLOW!");
                            }

                            if (!in_array($ext, $allowedExts)) {
                                return $fail("Only png, jpg, jpeg, pdf images are allowed");
                            }
                        }
                        if (count($imgs) > 5) {
                            return $fail("Maximum 5 images can be uploaded");
                        }
                    },
                ],
                'message' => 'required',
            ]);
            $ticket->status = 1;
            $ticket->save();

            $message->supportticket_id = $ticket->id;
            $message->type = 2;
            $message->message = $request->message;
            $message->save();

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $image) {
                    $filename = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
                    $image->move('assets/images/support', $filename);
                    SupportAttachment::create([
                        'support_message_id' => $message->id,
                        'image' => $filename,
                    ]);
                }
            }

            send_ticket_email($ticket,'admin-reply-support',[
                'subject' => $ticket->subject,
                'replied' => $request->message
            ]);

            $notify[] = ['success',"Support ticket replied successfully"];

        } elseif ($request->replayTicket == 2) {
            $ticket->status = 3;
            $ticket->save();

            $notify[] = ['success',"Support ticket closed successfully"];
        }
        return back()->withNotify($notify);
    }

    public function ticketDownload($ticket_id)
    {
        $attachment = SupportAttachment::findOrFail(Crypt::decrypt($ticket_id));
        $file = $attachment->image;
        $full_path = 'assets/images/support/' . $file;
        $title = str_slug($attachment->supportMessage->ticket->subject);
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $mimetype = mime_content_type($full_path);

        header('Content-Disposition: attachment; filename="' . $title . '.' . $ext . '";');
        header("Content-Type: " . $mimetype);
        return readfile($full_path);
    }

    public function ticketDelete(Request $request)
    {
        $message = SupportMessage::findOrFail($request->message_id);
        if ($message->attachments()->count() > 0) {
            foreach ($message->attachments as $img) {
                @unlink('assets/images/support/' . $img->image);
                $img->delete();
            }
        }
        $message->delete();

        $notify[] = ['success',"Delete Successfully"];
        return back()->withNotify($notify);

    }


}
