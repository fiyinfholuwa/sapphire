<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppliedCourse;
use App\Models\Slide;
use App\Models\Course;
use App\Models\LiveSession;
use App\Models\InstructorNotification;
use App\Models\Assignment;
use App\Models\UserChat;
use App\Models\SubmitAssignment;
use App\Models\GitHubLink;
use App\Models\RecordLink;
use Auth;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function resource_view(){
        $fetch_user_details = $this->user_info();
        return view('user.resource_view', compact('fetch_user_details'));
    }

    public function resource_detail($id){
        $course_title = Course::where('id', '=', $id)->first();
        $resources = Slide::where('course_id', '=', $id)
        ->where('status', '=', 'active')->get();
        return view('user.resource_detail', compact('resources', 'course_title'));
    }

    
    public function course_active(){
        $courses= $this->user_info_pending();
        return view('user.course_active', compact('courses'));
    }

    public function course_complete(){
        $courses= $this->user_info_complete();
        return view('user.course_complete', compact('courses'));
    }

    public function session_view(){
        $fetch_user_details = $this->user_info_pending();
        return view('user.session_view', compact('fetch_user_details'));
    }

    public function session_all($id){
        $course_title = Course::where('id', '=', $id)->first();
        $sessions = LiveSession::where('course_id', '=', $id)
        ->where('status', '=', 'active')->get();
        return view('user.session_all', compact('sessions', 'course_title'));
    }

    public function notification_view(){
        $fetch_user_details = $this->user_info_pending();
        return view('user.notification_view', compact('fetch_user_details'));
    }

    public function assignment_view_user(){
        $fetch_user_details = $this->user_info_pending();
        return view('user.assignment_view', compact('fetch_user_details'));
    }

    public function notification_all($id){
        $course_title = Course::where('id', '=', $id)->first();
        $notifications = InstructorNotification::where('course_id', '=', $id)
        ->where('status', '=', 'active')->get();
        return view('user.notification_all', compact('notifications', 'course_title'));
    }

    public function assignment_user_all($id){
        $course_title = Course::where('id', '=', $id)->first();
        $assignments = Assignment::where('course_id', '=', $id)
        ->where('status', '=', 'active')->get();
        return view('user.assignment_all', compact('assignments', 'course_title'));
    }

    public function assignment_submit($id){
        $assignment = Assignment::findOrFail($id);
        return view('user.assignment_submit', compact('assignment'));
    }


    public function assignment_submit_user(Request $request, $id){
        
        $check_assignment = Assignment::where('id', '=', $id)->first();
        $course_id = $check_assignment->course_id;
        $assignment_id = $check_assignment->id;
        $check_assignment_submitted = SubmitAssignment::where('course_id', '=', $course_id)->where('assessment_id', '=', $assignment_id)
        ->where('status', '=', "pending")->first();

        $check_graded_assignment = SubmitAssignment::where('course_id', '=', $course_id)->where('assessment_id', '=', $assignment_id)
        ->where('status', '=', "graded")->first();
        if(!$check_assignment_submitted){
            $submit = new SubmitAssignment;
            if($request->hasfile('image')){
                $image = $request->file('image');
                $extension = $image->getClientOriginalName();
                $filename = $extension;
                $file_unique_name = uniqid();
                $image->storeAs( '/assignment' , "/" . $file_unique_name . "_syntax" . "." .$filename, 'public');
                $path = "storage/assignment/" . $file_unique_name . "_syntax" . "." .$filename;
            }else{
                $path = NULL;
            }
            $submit->course_id = $request->course_id;
            $submit->assessment_id = $request->assignment_id;
            $submit->image = $path;
            $submit->link = $request->link;
            $submit->status = "pending";
            $submit->status_in = 0;
            $submit->user_id = Auth::user()->id;
            $submit->save();
            $notification = array(
                'message' => 'Assignment Submitted successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('assignment.submitted.user')->with($notification);

        }elseif($check_graded_assignment){
            $notification = array(
                'message' => 'Assignment has already been graded',
                'alert-type' => 'error'
            );
            return redirect()->route('assignment.submitted.user')->with($notification);
        }else{

            $check_assignment_submitted->delete();
            $submit = new SubmitAssignment;
            if($request->hasfile('image')){
                $image = $request->file('image');
                $extension = $image->getClientOriginalName();
                $filename = $extension;
                $file_unique_name = uniqid();
                $image->storeAs( '/assignment' , "/" . $file_unique_name . "_syntax" . "." .$filename, 'public');
                $path = "storage/assignment/" . $file_unique_name . "_syntax" . "." .$filename;
            }else{
                $path = NULL;
            }
            $submit->course_id = $request->course_id;
            $submit->assessment_id = $request->assignment_id;
            $submit->image = $path;
            $submit->link = $request->link;
            $submit->status = "pending";
            $submit->status_in = 0;
            $submit->user_id = Auth::user()->id;
            $submit->save();
            $notification = array(
                'message' => 'Assignment Submitted successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('assignment.submitted.user')->with($notification);

        }
        
    }


    public function assignment_submitted(){
        $assignments = SubmitAssignment::where('user_id', '=', Auth::user()->id)->get();
        return view('user.submitted_assignment', compact('assignments'));
    }

    public function user_info(){
        return AppliedCourse::where('user_id', '=', Auth::user()->id)->get();
    }

    public function user_info_pending(){
        return AppliedCourse::where('user_id', '=', Auth::user()->id)
        ->where('status', '=', 'pending')->get();
    }

    public function user_info_complete(){
        return AppliedCourse::where('user_id', '=', Auth::user()->id)
        ->where('status', '=', 'completed')->get();
    }

    public function chat_user_view(){
        $course_ids = AppliedCourse::where('user_id', '=', Auth::user()->id)
        ->where('status', '=', 'pending')->get();
        $ids = collect($course_ids)->pluck('course_id');
        $courses = Course::whereIn('id', $ids)
        ->select('id', 'title')
        ->get(); 
        return view('user.chat_view', compact('courses'));
    }
    public function chat_user_add(Request $request){
        $chat = new UserChat;
        $chat->user_id = Auth::user()->id;
        $chat->name = Auth::user()->first_name . " " . Auth::user()->last_name;
        $chat->user_message = $request->message;
        $chat->course_id = $request->course_id;
        $chat->instructor_status = "pending";
        $chat->save();
        $notification = array(
            'message' => 'Message sent to Instructor',
            'alert-type' => 'success'
        );
        return redirect()->route('chat.user.all')->with($notification);

    }

    public function chat_user_all(){
        $chats = UserChat::where('user_id', '=', Auth::user()->id)->get();
        return view('user.chat_all', compact('chats'));
    }

    public function user_chat_reply_view($id){
        $chat = UserChat::findOrFail($id);
        $chat->user_status = "viewed";
        $chat->save();
        return view('user.user_instructor', compact('chat'));
    }
    public function user_github(){
        $github = GitHubLink::first();
        return view('user.github', compact('github'));
    }

    public function user_record(){
        $record = RecordLink::first();
        return view('user.record', compact('record'));
    }

    public function user_password_view(){
        return view('user.change_password');
    }

    public function user_password_change(Request $request){
    $user = Auth::user();
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    if (Hash::check($request->old_password, $user->password)) {
        $user->password = Hash::make($request->new_password);
        $user->save();
        $notification = array(
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }else{
        $notification = array(
            'message' => 'Incorrect Password, Please try again.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

}

}
