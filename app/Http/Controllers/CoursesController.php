<?php

namespace App\Http\Controllers;

use App\Course;
use App\Mail\CourseRegisterEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CoursesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()){
            //$courses= Course::all();
            //return response()->json([ 'courses'=>$courses]);
            return Course::all();
        }else{
            return view('cuentas.index');
        }
    }


    public function store(Request $request)
    {
        $course=Course::create($request->all());
        Mail::to('pruebas@zeroazul.com')->queue(new CourseRegisterEmail($course));

        return $course;
    }


    public function update(Request $request, $id)
    {
        $course=Course::find($id);
        $course->name= $request->name;
        $course->description= $request->description;
        $course->update();
        return $course;
    }

    public function destroy($id)
    {
        $course=Course::find($id);
        $course->delete();
        return $course;
    }

}
