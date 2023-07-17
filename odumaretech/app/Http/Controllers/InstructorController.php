<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\ApprovedInstructor;
use App\Models\Course;
use App\Models\Slide;
use App\Models\Assignment;
use App\Models\LiveSession;
use App\Models\InstructorNotification;
use App\Models\SubmitAssignment;
use App\Models\InstructorChat;
use App\Models\UserChat;
use App\Models\User;
use App\Models\GitHubLink;
use App\Models\MeetingLink;
use App\Models\RecordLink;
use Illuminate\Support\Facades\File;

class InstructorController extends Controller
{
    public function slide_view(){
        $courses = $this->get_instructor_courses();
        return view('instructor.slide_view', compact('courses'));
    }

    public function slide_add(Request $request){
        $new_slide = new Slide;

        $image = $request->file('image');
        $extension = $image->getClientOriginalName();
        $filename = $extension;
        $file_unique_name = uniqid();
        $image->storeAs( '/slide' , "/" . $file_unique_name . "_syntax" . "." .$filename, 'public');
        $path = "storage/slide/" . $file_unique_name . "_syntax" . "." .$filename;
        $new_slide->course_id = $request->course_id;
        $new_slide->title = $request->title;
        $new_slide->status = "pending";
        $new_slide->image = $path;
        $new_slide->save();
        $notification = array(
            'message' => 'Slide saved to draft',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function slide_all(){
        $slides = Slide::all();
        return view('instructor.slide_all', compact('slides'));
    }

    public function slide_delete(Request $request, $id){
        $slide =  Slide::findOrFail($id);
        $filePath = $slide->image;
        File::delete(public_path($filePath));
        $slide->delete();
         $notification = array(
             'message' => 'Slide Successfully Deleted',
             'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
    }

    public function slide_edit($id){
        $courses = $this->get_instructor_courses();
        $slide = Slide::findOrFail($id);
        return view('instructor.slide_edit', compact('slide', 'courses'));
    }

    public function slide_update(Request $request, $id){
        $slide_update = Slide::findOrFail($id);

        if($request->hasfile('image')){
            $image = $request->file('image');
            $extension = $image->getClientOriginalName();
            $filename = $extension;
            $file_unique_name = uniqid();
            $image->storeAs( '/slide' , "/" . $file_unique_name . "_syntax" . "." .$filename, 'public');
            $path = "storage/slide/" . $file_unique_name . "_syntax" . "." .$filename;
        }else{
            $path = $slide_update->image;
        }
        $slide_update->course_id = $request->course_id;
        $slide_update->title = $request->title;
        $slide_update->status = $request->status;
        $slide_update->image = $path;
        $slide_update->save();
        $notification = array(
            'message' => 'Slide Successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('slide.all')->with($notification);
    }

    public function assignment_view(){
        $courses = $this->get_instructor_courses();
        return view('instructor.assignment_view', compact('courses'));
    }

    public function assignment_add(Request $request){
        $new_assignment = new Assignment;
        $new_assignment->course_id = $request->course_id;
        $new_assignment->title = $request->title;
        $new_assignment->status = "pending";
        $new_assignment->description = $request->description;
        $new_assignment->save();
        $notification = array(
            'message' => 'Assigment saved to draft',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function assignment_all(){
        $assignments = Assignment::all();
        return view('instructor.assignment_all', compact('assignments'));
    }

    public function assignment_delete(Request $request, $id){
        $assignment =  Assignment::findOrFail($id);
        $assignment->delete();
         $notification = array(
             'message' => 'Assignment Successfully Deleted',
             'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
    }

    public function assignment_edit($id){
        $courses = $this->get_instructor_courses();
        $assignment = Assignment::findOrFail($id);
        return view('instructor.assignment_edit', compact('assignment', 'courses'));
    }

    public function assignment_update(Request $request, $id){
        $ass_update = Assignment::findOrFail($id);

        $ass_update->course_id = $request->course_id;
        $ass_update->title = $request->title;
        $ass_update->status = $request->status;
        $ass_update->description = $request->description;
        $ass_update->save();
        $notification = array(
            'message' => 'Assignment Successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('assignment.all')->with($notification);
    }


    public function session_view(){
        $courses = $this->get_instructor_courses();
        return view('instructor.session_view', compact('courses'));
    }

    public function session_add(Request $request){
        $new_session = new LiveSession;
        $new_session->course_id = $request->course_id;
        $new_session->title = $request->title;
        $new_session->status = "pending";
        $new_session->description = $request->description;
        $new_session->time = $request->date;
        $new_session->save();
        $notification = array(
            'message' => 'Session saved to draft',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function session_all(){
        $sessions = LiveSession::all();
        return view('instructor.session_all', compact('sessions'));
    }

    public function session_delete(Request $request, $id){
        $session =  LiveSession::findOrFail($id);
        $session->delete();
         $notification = array(
             'message' => 'Session Successfully Deleted',
             'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
    }

    public function session_edit($id){
        $courses = $this->get_instructor_courses();
        $session = LiveSession::findOrFail($id);
        return view('instructor.session_edit', compact('session', 'courses'));
    }

    public function session_update(Request $request, $id){
        $ss_update = LiveSession::findOrFail($id);

        $ss_update->course_id = $request->course_id;
        $ss_update->title = $request->title;
        $ss_update->status = $request->status;
        $ss_update->description = $request->description;
        $ss_update->time = $request->date;
        $ss_update->save();
        $notification = array(
            'message' => 'Session Successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('session.all.instructor')->with($notification);
    }

    public function notification_view(){
        $courses = $this->get_instructor_courses();
        return view('instructor.notification_view', compact('courses'));
    }

    public function notification_add(Request $request){
        $new_not = new InstructorNotification;
        $new_not->course_id = $request->course_id;
        $new_not->title = $request->title;
        $new_not->status = "pending";
        $new_not->description = $request->description;
        $new_not->save();
        $notification = array(
            'message' => 'Notification saved to draft',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function notification_all(){
        $notifications = InstructorNotification::all();
        return view('instructor.notification_all', compact('notifications'));
    }

    public function notification_delete(Request $request, $id){
        $notify =  InstructorNotification::findOrFail($id);
        $notify->delete();
         $notification = array(
             'message' => 'Notification Successfully Deleted',
             'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
    }

    public function notification_edit($id){
        $courses = $this->get_instructor_courses();
        $notification = InstructorNotification::findOrFail($id);
        return view('instructor.notification_edit', compact('notification', 'courses'));
    }

    public function notification_update(Request $request, $id){
        $not_update = InstructorNotification::findOrFail($id);
        $not_update->course_id = $request->course_id;
        $not_update->title = $request->title;
        $not_update->status = $request->status;
        $not_update->description = $request->description;
        $not_update->save();
        $notification = array(
            'message' => 'Notification Successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('notification.all')->with($notification);
    }

    public function assignment_instructor_grade(Request $request, $id){
        $assignment = SubmitAssignment::findOrFail($id);
        $assignment->status_in = $request->score;
        $assignment->status = "graded";
        $assignment->save();
        $notification = array(
            'message' => 'Assignment Successfully graded',
            'alert-type' => 'success'
        );
        return redirect()->route('assignment.submitted.review')->with($notification);
    }
    public function assess_submitted_assignment(){
            $courseIds = $this->get_instructor_courses_id();
            $assignments = SubmitAssignment::whereIn('course_id', $courseIds)->get();
            return view('instructor.submitted_assignment', compact('assignments'));
    }

    public function view_submitted_assignment($id){
        $assignment = SubmitAssignment::findOrFail($id);
        return view('instructor.assignment_review', compact('assignment'));
    }

    public function get_instructor_courses(){
        $fetch_instructor_detail = ApprovedInstructor::where('user_id', '=', Auth::user()->id)->first();
        $course_ids = $fetch_instructor_detail->course_ids;
        $courses = Course::whereIn('id', array_map('intval', $course_ids))
        ->select('id', 'title')
        ->get();
        return $courses;
    }

    public function get_instructor_courses_id(){
        $fetch_instructor_detail = ApprovedInstructor::where('user_id', '=', Auth::user()->id)->first();
        $course_ids = $fetch_instructor_detail->course_ids;
        $courses = Course::whereIn('id', array_map('intval', $course_ids))
        ->select('id')
        ->get();
        return $courses;
    }

    public function instructor_chat_view(){
        return view('instructor.instructor_chat');
    }

    public function instructor_chat_add(Request $request){
        $chat = new InstructorChat;
        $chat->user_id = Auth::user()->id;
        $chat->name = Auth::user()->first_name . " " . Auth::user()->last_name;
        $chat->instructor_message = $request->message;
        $chat->admin_status = "pending";
        $chat->save();
        $notification = array(
            'message' => 'Message sent to Admin',
            'alert-type' => 'success'
        );
        return redirect()->route('instructor.chat.all')->with($notification);
    }

    public function instructor_chat_all(){
        $chats = InstructorChat::where('user_id', '=', Auth::user()->id)->get();
        return view('instructor.chat_all', compact('chats'));
    }

    public function student_chat_all(){
        $user_id = Auth::user()->id;
        $instructor = ApprovedInstructor::where('user_id', '=', $user_id)->first();
        $course_ids = $instructor->course_ids;
        $chats = UserChat::whereIn('course_id', $course_ids)->get();
        return view('instructor.chat_student', compact('chats'));
    }

    public function student_user_chat_reply($id){
        $chat = UserChat::findOrFail($id);
        return view('instructor.student_chat_reply', compact('chat'));
    }

    public function instructor_chat_replied(Request $request, $id){
        $chat = UserChat::findOrFail($id);
        $chat->instructor_message = $request->message;
        $chat->instructor_status = "replied";
        $chat->save();
        $notification = array(
            'message' => 'Message replied',
            'alert-type' => 'success'
        );
        return redirect()->route('student.chat')->with($notification);
    }


    public function instructor_chat_reply($id){
        $chat = InstructorChat::findOrFail($id);
        $chat->instructor_status = "viewed";
        $chat->save();
        return view('instructor.chat_reply', compact('chat'));
    }

    public function instructor_student_chat_reply($id){
        $chat = UserChat::findOrFail($id);
        return view('instructor.student_chat_reply', compact('chat'));
    }

    public function instructor_student_chat_reply_add(Request $request, $id){
        $chat = UserChat::findOrFail($id);
        $chat->instructor_message = $request->message;
        $chat->instructor_status = "replied";
        $chat->user_status = "pending";
        $chat->save();
        $notification = array(
            'message' => 'Message replied',
            'alert-type' => 'success'
        );
        return redirect()->route('student.chat')->with($notification);
    }

    public function instructor_github(){
        $github = GitHubLink::first();
        return view('instructor.github', compact('github'));
    }

    public function instructor_record(){
        $record = RecordLink::first();
        return view('instructor.record', compact('record'));
    }

    public function instructor_meeting(){
        $meeting = MeetingLink::first();
        return view('instructor.meeting', compact('meeting'));
    }


    public function instructor_password_view(){
        return view('instructor.change_password');
    }

    public function instructor_password_change(Request $request){
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