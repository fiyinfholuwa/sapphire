<?php

namespace App\Http\Controllers;
use Mail;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Course;
use App\Models\CompanyTraining;
use App\Models\Instructor;
use App\Models\User;
use App\Models\ApprovedInstructor;
use App\Models\InstructorChat;
use App\Models\Innovation;
use Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Mail\ApplicantNotification;
use App\Mail\CorporateMail;
use App\Mail\InstructorApply;


class HomeController extends Controller
{
    public function index(){
        $testimonials = Testimonial::all();
        $courses  = Course::offset(0)->limit(3)->get();
        return view('frontend.home', compact('testimonials', 'courses'));
    }

    public function testimonial_view(){
        return view('admin.testimonial_view');
    }

    public function testimonial_add(Request $request){
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'title' => 'required'
        ]);
        $image = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalName();
        $resizedImage = Image::make($image)->resize(200, 200);
        $image->storeAs( '/testimonial/'.$filename , $resizedImage, 'public');
        $path = "storage/testimonial/".$filename;
        $bank_statement_save = $path;
        $new_test = new Testimonial;
        $new_test->name = $request->name;
        $new_test->content = $request->content;
        $new_test->title = $request->title;
        $new_test->image = $path;
        $new_test->save();
        $notification = array(
            'message' => 'Testimonial Successfully added',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function testimonial_all(){
        $testimonials = Testimonial::all();
        return view('admin.testimonial_all', compact('testimonials'));
    }

    public function testimonial_delete($id){
       $testimonial =  Testimonial::findOrFail($id);
       $filePath = $testimonial->image;
       File::delete(public_path($filePath));
       $testimonial->delete();
        $notification = array(
            'message' => 'Testimonial Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 
    }

    public function testimonial_edit($id){
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial_edit', compact('testimonial'));
    }

    public function testimonial_update(Request $request, $id){
        $testimonial_update = Testimonial::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'title' => 'required'
        ]);
        if($request->hasfile('image')){
            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalName();
            $resizedImage = Image::make($image)->resize(200, 200);
            $image->storeAs( '/testimonial/'.$filename , $resizedImage, 'public');
            $path = "storage/testimonial/".$filename;
        }else{
            $path = $testimonial_update->image;
        }
        $testimonial_update->name = $request->name;
        $testimonial_update->content = $request->content;
        $testimonial_update->title = $request->title;
        $testimonial_update->image = $path;
        $testimonial_update->save();
        $notification = array(
            'message' => 'Testimonial Successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('testimonial.all')->with($notification);
    }

    public function company_view(){
        return view('frontend.company');
    }

    public function company_add(Request $request){
        $training = new CompanyTraining;
        $training->name = $request->name;
        $training->email = $request->email;
        $training->phone = $request->phone;
        $training->intrested_in = $request->intrested_in;
        $training->career = $request->career;
        $training->location = $request->location;
        $training->save();
        $mailData = [
            'company' => $request->name
        ];
        Mail::to($request->email)->send(new CorporateMail($mailData));
        $notification = array(
            'message' => 'Your Request Successfully saved, we will get back to you shortly',
            'alert-type' => 'success'
        );
        return redirect()->route('home')->with($notification);
    }

    public function company_all(){
        $company_requests = CompanyTraining::all();
        return view('admin.company_all', compact('company_requests'));
    }

    public function instructor_view(){
        $courses = Course::all();
        return view('frontend.instructor', compact('courses'));
    }

    public function instructor_add(Request $request){
        $instructor= new Instructor;
        
        $resume = $request->file('resume');
        $extension = $resume->getClientOriginalName();
        $filename = $extension;
        $resume->storeAs( '/resume' , "/" . $request->first_name . "_syntax" . "." .$filename, 'public');
        $path = "storage/resume/" . $request->first_name . "_syntax" . "." .$filename;

        $instructor->first_name = $request->first_name;
        $instructor->last_name= $request->last_name;
        $instructor->gender = $request->gender;
        $instructor->email = $request->email;
        $instructor->career = $request->career;
        $instructor->resume= $path;
        $instructor->course_ids = $request->course_ids;
        $instructor->save();

        $mailData = [
            'name' => $request->last_name
        ];
        Mail::to($request->email)->send(new InstructorApply($mailData));
        $notification = array(
            'message' => 'Application Successfully sent, we will get back to you shortly',
            'alert-type' => 'success'
        );
        return redirect()->route('home')->with($notification);

    }

    public function instructor_application_all(){
        $applicants = Instructor::all();
        return view('admin.instructor_application_all', compact('applicants'));
    }

    public function applicant_delete(Request $request, $id){
        $applicant =  Instructor::findOrFail($id);
        $filePath = $applicant->resume;
        File::delete(public_path($filePath));
        $applicant->delete();
         $notification = array(
             'message' => 'Applicant Successfully Deleted',
             'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
    }

    public function applicant_edit($id){
        $courses = Course::all();
        $applicant = Instructor::findOrFail($id);
        return view('admin.applicant_edit', compact('courses', 'applicant'));
    }
    public function applicant_update(Request $request, $id){
    
        
        $check_email = User::where('email', '=', $request->email)->first();
        if($check_email){
            $notification = array(
                'message' => 'Email Already Exist',
                'alert-type' => 'error'
            );
            return redirect()->route('instructor.application.all')->with($notification);
        }
        if($request->status == "approved" && $request->course_ids == NULL){
            $notification = array(
                'message' => 'Please Select at least a course for the Instructor',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        if($request->status == "approved"){
            $prefix = 'Instructor'; // Prefix or school code
        $studentID = $this->generateStudentID($prefix); 
        $password = $this->generateStudentID($request->first_name);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'student_id' => $studentID,
            'password' => Hash::make($password),
            'user_type' => "1"
        ]);
        $user_id = $user->id;
        $approved_instructor = new ApprovedInstructor;
        $approved_instructor->user_id = $user_id;
        $approved_instructor->course_ids = $request->course_ids;
        $approved_instructor->save();

        $message = 'Dear ' . $request->last_name . ',' . PHP_EOL . PHP_EOL .
    'I am thrilled to inform you that you have been selected for the position of an Instructor at OdumareTech. Congratulations on securing the job! We were highly impressed by your skills, experience, and passion for education.' . PHP_EOL . PHP_EOL .
    'We believe that your expertise and teaching abilities will be invaluable in creating an exceptional learning experience for our students. We are excited to have you join our team and contribute to our mission of transforming education.' . PHP_EOL . PHP_EOL .
    'Welcome aboard, and we look forward to working with you to make a positive impact in the lives of learners around the world!' . PHP_EOL . PHP_EOL .
    'Below is your login details';


        $mailData = [
            'status' => $request->status,
            'password' => $password,
            'message' => $message
        ];
        Mail::to($request->email)->send(new ApplicantNotification($mailData));
        $notification = array(
            'message' => 'Applicant Successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('instructor.application.all')->with($notification);

        }else{

        $applicant =  Instructor::findOrFail($id);
        $applicant->status = $request->status;
        $applicant->save();
            $message = 'Dear ' . $request->last_name . ',' . PHP_EOL . PHP_EOL .
    'Thank you for your application and your interest in joining our team at OdumareTech. We appreciate the time and effort you put into the application process.' . PHP_EOL . PHP_EOL .
    'After careful consideration, we regret to inform you that we have decided not to move forward with your application at this time. While your qualifications and experience are commendable, we had to make a difficult decision based on our specific requirements and current circumstances.' . PHP_EOL . PHP_EOL .
    'We sincerely appreciate your interest in our organization and the dedication you have shown to the field of education. We encourage you to continue pursuing your passion for teaching and wish you the very best in your future endeavors.' . PHP_EOL . PHP_EOL .
    'Thank you once again for considering us as a potential employer, and we extend our best wishes for your continued professional success.';

            $mailData = [
                'status' => $request->status,
                'password' => "",
                'message' => $message
            ];
            Mail::to('fiyinfholuwa@gmail.com')->send(new ApplicantNotification($mailData));
            $notification = array(
                'message' => 'Applicant Successfully updated',
                'alert-type' => 'success'
            );
            return redirect()->route('instructor.application.all')->with($notification);
        }
        
    }

    public function admin_chat_all(){
        $chats = InstructorChat::all();
        return view('admin.chat_all', compact('chats'));
    }

    public function admin_chat_reply($id){
        $chat = InstructorChat::findOrFail($id);
        return view('admin.chat_reply', compact('chat'));
    }

    public function admin_chat_replied(Request $request, $id){
        $chat = InstructorChat::findOrFail($id);
        $chat->admin_message = $request->message;
        $chat->admin_status = "replied";
        $chat->instructor_status = "pending";
        $chat->save();
        $notification = array(
            'message' => 'Message replied',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.chat.all')->with($notification);
    }


    public function innovation_view(){
        return view('admin.innovation_view');
    }

    public function innovation_add(Request $request){
       
        $image = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalName();
        $resizedImage = Image::make($image)->resize(200, 200);
        $image->storeAs( '/innovation/'.$filename , $resizedImage, 'public');
        $path = "storage/innovation/".$filename;
        $bank_statement_save = $path;
        $new_inno = new Innovation;
        $new_inno->name = $request->name;
        $new_inno->github = $request->github;
        $new_inno->link = $request->link;
        $new_inno->image = $path;
        $new_inno->save();
        $notification = array(
            'message' => 'Innovation Successfully added',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function innovation_all(){
        $innovations = Innovation::all();
        return view('admin.innovation_all', compact('innovations'));
    }

    public function innovation_delete($id){
       $innovation =  Innovation::findOrFail($id);
       $filePath = $innovation->image;
       File::delete(public_path($filePath));
       $innovation->delete();
        $notification = array(
            'message' => 'Innovation Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 
    }

    public function innovation_edit($id){
        $innovation = Innovation::findOrFail($id);
        return view('admin.innovation_edit', compact('innovation'));
    }

    public function innovation_update(Request $request, $id){
        $inno_update = Innovation::findOrFail($id);

        if($request->hasfile('image')){
            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalName();
            $resizedImage = Image::make($image)->resize(200, 200);
            $image->storeAs( '/innovation/'.$filename , $resizedImage, 'public');
            $path = "storage/innovation/".$filename;
        }else{
            $path = $inno_update->image;
        }
        $inno_update->name = $request->name;
        $inno_update->github = $request->github;
        $inno_update->link = $request->link;
        $inno_update->image = $path;
        $inno_update->save();
        $notification = array(
            'message' => 'Innovation Successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('innovation.all')->with($notification);
    }



    public function generateStudentID($prefix, $length = 6) {
        $randomNumber = mt_rand(pow(10, $length - 1), pow(10, $length) - 1);
        $studentID = $prefix . $randomNumber;
        return $studentID;
    }
}
