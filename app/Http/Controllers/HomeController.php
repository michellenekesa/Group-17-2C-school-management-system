<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\graduation;
use App\Models\timetable;
use App\Models\course;
use App\Models\resource;
use App\Models\message_class;
use App\Models\message_staff;

class HomeController extends Controller
{
    public function redirect(){


        if (Auth::id()) {
            if (Auth::user()->user_type=='0') {
                        $message_store = message_class::all();
                        $student_store = User::where('user_type','0')->get();
                        $lecturer_store = User::where('user_type','2')->get();
                        $resource_store = resource::all();
                        $course_store = course::all();
                        $graduation_store = graduation::all();
                        $timetable_store = timetable::all();
                        return view('student.home', compact('message_store','student_store','lecturer_store','resource_store','course_store', 'graduation_store', 'timetable_store'));
                    }else if (Auth::user()->user_type=='2') {
                        $lecturer_store = User::where('user_type','2')->get();
                        $message_store = message_class::all();
                        $course_store = course::all();
                        $resource_store = resource::all();
                        return view('lecturer.home', compact('lecturer_store','message_store','course_store','resource_store'));
                    }else if (Auth::user()->user_type=='3') {
                        $staff_store = User::where('user_type','3')->get();
                        $message_store = message_staff::all();
                        return view('staff.home', compact('staff_store','message_store'));
                    }
            else if (Auth::user()->user_type=='1') {
                        // $userid = Auth::user()->id;
                        $administrator_store = User::where('user_type','1')->get();
                        $student_store = User::where('user_type','0')->get();
                        $lecturer_store = User::where('user_type','2')->get();
                        $staff_store = User::where('user_type','3')->get();
                        $course_store = course::all();
                        $graduation_store = graduation::all();
                        $timetable_store = timetable::all();
                        return view('admin.home', compact('administrator_store','student_store','lecturer_store','staff_store','course_store', 'graduation_store', 'timetable_store'));
                    }else{
                   return view('users.home');
            }        
        }else{
            return redirect->back();
        }

    }

        public function index(){
        return view('users.home');
    }
    
}
