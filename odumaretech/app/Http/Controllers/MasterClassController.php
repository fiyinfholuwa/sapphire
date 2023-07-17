<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterClassLink;
use App\Models\GitHubLink;
use App\Models\MeetingLink;
use App\Models\RecordLink;
use App\Models\MasterClass;
use Mail;
use App\Mail\MasterClassMail;

class MasterClassController extends Controller
{
    public function masterclass(){
        return view('frontend.masterclass');
    }
    public function masterclass_link(){
        $masterclass_link = MasterClassLink::first();
        return view('admin.masterclass_link', compact('masterclass_link'));
    }


    public function github_link(){
        $github_link = GitHubLink::first();
        return view('admin.github', compact('github_link'));
    }

    public function meeting_link(){
        $meeting_link = MeetingLink::first();
        return view('admin.meeting_link', compact('meeting_link'));
    }


    public function record_link(){
        $record_link = RecordLink::first();
        return view('admin.record_link', compact('record_link'));
    
    }

    public function masterclass_link_add(Request $request, $id=null){
        if($request->id ==null || $request->id ==""){
            $masterclass_link = new MasterClassLink;
            $masterclass_link->link = $request->link;
            $masterclass_link->date = $request->date;
            $masterclass_link->time = $request->time;
            $masterclass_link->title = $request->title;
            $masterclass_link->save();
            $notification = array(
                'message' => 'MasterClass Link Sucessfully saved',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $update_link =  MasterClassLink::findOrFail($request->id);
            $update_link->link = $request->link;
            $update_link->date = $request->date;
            $update_link->time = $request->time;
            $update_link->title = $request->title;
            $update_link->save();
            $notification = array(
                'message' => 'MasterClass Link Sucessfully updated',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function github_link_add(Request $request, $id=null){
        if($request->id ==null || $request->id ==""){
            $github_link = new GitHubLink;
            $github_link->link = $request->link;
            $github_link->save();
            $notification = array(
                'message' => 'GitHub Link Sucessfully saved',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $update_link =  GitHubLink::findOrFail($request->id);
            $update_link->link = $request->link;
            $update_link->save();
            $notification = array(
                'message' => 'Github Link Sucessfully updated',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function meeting_link_add(Request $request, $id=null){
        if($request->id ==null || $request->id ==""){
            $meeting_link = new MeetingLink;
            $meeting_link->link = $request->link;
            $meeting_link->save();
            $notification = array(
                'message' => 'Meeting Link Sucessfully saved',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $update_link =  MeetingLink::findOrFail($request->id);
            $update_link->link = $request->link;
            $update_link->save();
            $notification = array(
                'message' => 'Meeting Link Sucessfully updated',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }


    public function record_link_add(Request $request, $id=null){
        if($request->id ==null || $request->id ==""){
            $record_link = new RecordLink;
            $record_link->link = $request->link;
            $record_link->save();
            $notification = array(
                'message' => 'Record Link Sucessfully saved',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $update_link =  RecordLink::findOrFail($request->id);
            $update_link->link = $request->link;
            $update_link->save();
            $notification = array(
                'message' => 'Record Link Sucessfully updated',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }



    public function masterclass_add(Request $request){
        $masterclass = new MasterClass;
        $masterclass->first_name = $request->first_name;
        $masterclass->last_name = $request->last_name;
        $masterclass->intrested_in = $request->intrested_in;
        $masterclass->gender = $request->gender;
        $masterclass->career = $request->career;
        $masterclass->location = $request->location;
        $masterclass->email = $request->email;
        $masterclass->save();

        $masterclass_link = MasterClassLink::first();
        $mailData = [
            'meeting_link' => $masterclass_link->link,
            'date' => $masterclass_link->date,
            'time' => $masterclass_link->time,
            'title' => $masterclass_link->title
        ];
        Mail::to($request->email)->send(new MasterClassMail($mailData));
        $notification = array(
            'message' => 'registeration successful, please check your email for the masterclass link',
            'alert-type' => 'success'
        );

        return redirect()->route('home')->with($notification);
    }

    public function masterclass_all(){
        $attendees = MasterClass::all();
        return view('admin.masterclass_all', compact('attendees'));
    }
}
