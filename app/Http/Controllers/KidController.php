<?php

namespace App\Http\Controllers;


use App\User;
use App\School;
use App\Classroom;
use App\Kid;

use Illuminate\Http\Request;

class KidController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function showClassroom($id = null)
    {
        $user = auth()->user();
        $classrooms = Classroom::where('school_id', $user->school_id)->get();

        if ($id == null){
            $classroom = Classroom::where('school_id', $user->school_id)->first();//$classroom = null;
            if ($classroom){
                return redirect('classroom/'.$classroom->id);
            }
        }else{
            $classroom = Classroom::where('id', $id)->first();
        }

        $kids = Kid::where('classroom_id', $classroom->id)->get();
        return view('kids.classroom', ['classrooms' => $classrooms, 'classroom'=> $classroom, 'kids'=> $kids]);
    }

    public function createClassroom(Request $request)
    {
        $user = auth()->user();
        $school = School::where('id', $user->school_id)->first();
        $classroom = Classroom::create([
            'class_name' => $request['class_name'],
        ]);

        $school->classrooms()->save($classroom);

        return redirect('classroom/'.$classroom->id);

    }
    public function editClassroom(Request $request, $id = null)
    {
    
        $classroom = Classroom::where('id', $id)->first();
        $classroom->class_name = $request['class_name'];
        $classroom->save();
        
        return redirect('classroom/'.$id);

    }
    public function toggleClassroom($id = null)
    {
    
        $classroom = Classroom::where('id', $id)->first();
        $classroom->active = !$classroom->active;
        $classroom->save();
        
        return redirect('classroom/'.$id);

    }
     public function deleteClassroom($id = null)
    {
    
        $classroom = Classroom::where('id', $id)->first();
        $classroom->delete();

        $user = auth()->user();
        $classroom = Classroom::where('school_id', $user->school_id)->first();//$classroom = null;
        
        return redirect('classroom/'.$classroom->id);

    }

    public function showKid($id = null)
    {
        $user = auth()->user();
        $classrooms = Classroom::where('school_id', $user->school_id)->get();
        //$kids = Kid::where('classroom_id', $classroom->id)->get();
        $kid = Kid::where('id', $id)->first();
        $classroom = Classroom::where('id', $kid->classroom_id)->first();

        
        return view('kids.kid', ['classrooms' => $classrooms, 'classroom'=> $classroom, 'kid'=> $kid]);
    }

    public function createKid(Request $request)
    {
        $user = auth()->user();
        $school = School::where('id', $user->school_id)->first();
        $birthday = $request['b-year'].'-'.$request['b-month'].'-'.$request['b-day'];
        $kid = Kid::create([
            'classroom_id' => $request['classroom_id'],
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'nickname' => $request['nickname'],
            'sex' => $request['sex'],
            'birthday' => date("Y-m-d", strtotime($birthday)),
        ]);

        $school->kids()->save($kid);

        return redirect('classroom/'.$request['classroom_id']);

    }
}

