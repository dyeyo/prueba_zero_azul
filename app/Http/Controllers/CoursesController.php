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
        $this->validate($request,[
            'name' => 'required'
        ]);

        $course = New Course;
        $course->name = $request->name;
        $course->description = $request->description;
        $course->save();
        //$course=Course::create($request->all());
        /**
         * ESTE EMAIL SOLO SE ENVIARA EN PRODUCCION, POR MOTIVOS DE PRUEBA TODO SE ALMACENA EN UN LOG
         * **/
        Mail::to('pruebas@zeroazul.com')->queue(new CourseRegisterEmail($course));
        return response()->json($course);
    }


    public function update(Request $request, $id)
    {
        $course=Course::find($id);
        $this->validate($request,[
            'name' => 'required'
        ]);
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
