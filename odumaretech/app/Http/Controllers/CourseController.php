<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\Coupon;
use App\Models\CouponUsed;
use App\Models\AppliedCourse;
use Image;

use Auth;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    public function all_course(){
        $courses  = Course::paginate(6);
        $categories = Category::all();
        return view('frontend.course', compact('courses','categories'));
    }
    public function category_view(){
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    public function category_add(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $url_slug = strtolower($request->name);
        $label_slug= preg_replace('/\s+/', '-', $url_slug);

        $category = new Category;
        $category->name = $request->name;
        $category->category_url = $label_slug;
        $category->save();
        $notification = array(
            'message' => 'Category Sucessfully saved',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function category_delete($id){
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 
    }

    public function category_edit($id){
        $category = Category::findOrFail($id);
        $categories = Category::all();
        return view('admin.category_edit', compact('category', 'categories'));
    }

    

    public function category_update(Request $request, $id){
        $category_update = Category::findOrFail($id);
        $url_slug = strtolower($request->name);
        $label_slug= preg_replace('/\s+/', '-', $url_slug);

        $category_update->name = $request->name;
        $category_update->category_url = $label_slug;
        $category_update->save();

        $notification = array(
            'message' => 'Category Successfully Updated',
            'alert-type' => 'success'
        );
        return redirect()->route('category.view')->with($notification);
    }

    public function course_view(){
        $categories = Category::all();
        return view('admin.course_view', compact('categories'));
    }

    public function course_add(Request $request){
        
        $url_slug = strtolower($request->title);
        $label_slug= preg_replace('/\s+/', '-', $url_slug);

        $image = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalName();
        $resizedImage = Image::make($image)->resize(1400, 1000);
        $image->storeAs( '/course/'.$filename , $resizedImage, 'public');
        $path = "storage/course/".$filename;
        $new_course = new Course;
        $new_course->title = $request->title;
        $new_course->course_url = $label_slug;
        $new_course->category = $request->category;
        $new_course->level = $request->level;
        $new_course->language = $request->language;
        $new_course->price = $request->price;
        $new_course->lecture = $request->lecture;
        $new_course->discount = $request->discount;
        $new_course->duration = $request->duration;
        $new_course->category = $request->category;
        $new_course->support = $request->support;
        $new_course->experience = $request->experience;
        $new_course->certification = $request->certification;
        $new_course->description = $request->description;
        $new_course->image = $path;
        $new_course->save();
        $notification = array(
            'message' => 'Course Successfully added',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function course_all(){
        $courses = Course::all();
        return view('admin.course_all', compact('courses'));
    }

    public function course_delete($id){
       $course =  Course::findOrFail($id);
       $filePath = $course->image;
       File::delete(public_path($filePath));
       $course->delete();
        $notification = array(
            'message' => 'Course Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 
    }

    public function course_edit($id){
        $categories = Category::all();
        $course = Course::findOrFail($id);
        return view('admin.course_edit', compact('course', 'categories'));
    }

    public function course_update(Request $request, $id){
        $update_course = course::findOrFail($id);

        if($request->hasfile('image')){
            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalName();
            $resizedImage = Image::make($image)->resize(200, 200);
            $image->storeAs( '/course/'.$filename , $resizedImage, 'public');
            $path = "storage/course/".$filename;
        }else{
            $path = $update_course->image;
        }
        $url_slug = strtolower($request->title);
        $label_slug= preg_replace('/\s+/', '-', $url_slug);
        $update_course->title = $request->title;
        $update_course->course_url = $label_slug;
        $update_course->category = $request->category;
        $update_course->level = $request->level;
        $update_course->language = $request->language;
        $update_course->price = $request->price;
        $update_course->lecture = $request->lecture;
        $update_course->discount = $request->discount;
        $update_course->duration = $request->duration;
        $update_course->category = $request->category;
        $update_course->support = $request->support;
        $update_course->experience = $request->experience;
        $update_course->certification = $request->certification;
        $update_course->description = $request->description;
        $update_course->image = $path;
        $update_course->save();
        
        $notification = array(
            'message' => 'Course successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('course.all')->with($notification);
    }

    public function course_detail($name){
        
        $course = Course::where('course_url', $name)->get()->first();
        if(Auth::check()){
            $check_user_has_coupon = CouponUsed::where('user_id', '=', Auth::user()->id)->where('course_id','=', $course->id)->first();
            $has_pending = AppliedCourse::where('user_id', '=', Auth::user()->id)->where('course_id', '=', $course->id)
            ->where('status' , '=' , "pending")->first();
        }else{
            $check_user_has_coupon = NULL;
            $has_pending = NULL;
        }
        $coupon_check = Coupon::where('course_id', '=', $course->id)->first();
       
        return view('frontend.course_detail', compact('course', 'coupon_check','check_user_has_coupon', 'has_pending' ));
    }

    public function course_category($name){
        $category = Category::where('category_url', '=', $name)->get()->first();
        $category_id = $category->id;
        $courses  = Course::where('category', '=', $category_id)->paginate(6);
        $course = Course::where('course_url', $name)->get()->first();
        $categories = Category::all();
        return view('frontend.category', compact('course', 'categories', 'courses', 'category'));
    }

    public function search(Request $request)
    {
        // Process the search query
        $searchTerm = $request->input('search');
        // Perform the search
        $categories = Category::all();
        $courses = Course::where('title', 'like', '%' . $searchTerm . '%')->paginate(6);
        // Return the search results page
        return view('frontend.search', compact('courses', 'searchTerm', 'categories'));
    }


    public function coupon_view(){
        $courses = Course::select('id', 'title')->get();
        $coupons = Coupon::all();
        return view('admin.coupon', compact('coupons', 'courses'));
    }

    public function coupon_add(Request $request){
      
        $coupon = new Coupon;
        $coupon->code = $request->code;
        $coupon->course_id = $request->course_id;
        $coupon->discount = $request->discount;
        $coupon->number = $request->number;
        $coupon->user_id = 0;
        $coupon->save();
        $notification = array(
            'message' => 'Coupon Sucessfully saved',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function coupon_delete($id){
        Coupon::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Coupon Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 
    }

    public function coupon_edit($id){
        $coupon = Coupon::findOrFail($id);
        $courses = Course::select('id', 'title')->get();
        $coupons = Coupon::all();
        return view('admin.coupon_edit', compact('coupons', 'courses', 'coupon'));
    }

    

    public function coupon_update(Request $request, $id){
        $coupon = Coupon::findOrFail($id);
        $coupon->code = $request->code;
        $coupon->course_id = $request->course_id;
        $coupon->discount = $request->discount;
        $coupon->number = $request->number;
        $coupon->user_id = 0;
        $coupon->save();
        $notification = array(
            'message' => 'Coupon Sucessfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('coupon.view')->with($notification);
    }

    public function coupon_validate(Request $request){
        $get_coupon = Coupon::where('code', '=', $request->code)->first();
        $get_coupon_exist = CouponUsed::where('coupon_id', '=', $request->coupon_id)->where('user_id', Auth::user()->id)->where('course_id', '=',$request->course_id)->first();

        if(!$get_coupon){
            $notification = array(
                'message' => 'Invalid Coupon Code',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $get_all_coupon_number = CouponUsed::where('coupon_id', '=',$get_coupon->id )->count();

        if($get_coupon_exist){
            $notification = array(
                'message' => 'Coupon Code Applied',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
            
        }elseif($get_all_coupon_number >= $get_coupon->number){
            $notification = array(
                'message' => 'Coupon Limit reached',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }else{
            $coupon = new CouponUsed;
            $coupon->user_id = Auth::user()->id;
            $coupon->course_id = $request->course_id;
            $coupon->coupon_id = $request->coupon_id;
            $coupon->save();
            $update_coupon_used = Coupon::where('code', '=', $get_coupon->code)->update(['user_id' => $get_coupon->user_id + 1]);
            $notification = array(
                'message' => 'Coupon Code Applied',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

    }

}
