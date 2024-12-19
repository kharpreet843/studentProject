<?php

namespace App\Http\Controllers\V1\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Auth;
use DB;

class StudentController extends Controller
{
	 public function index()
    {
        $students = Student::orderBy('id','desc')->paginate(10);
        return view('student.index', compact('students'));
    }
	public function store(Request $request)
	{    
		try{
			$request->validate([
				'name' => 'required|max:255',
				 'email' => 'required|email|unique:students,email',
			]);
			$insert=Student::create(['name'=>$request->name,'email'=>$request->email]);

			return redirect()->route('students.index')
			->with('success','Student created successfully.');
		}
		catch(Exception $e){

		}
	}
	// Updte query
  public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
            
        ]);
        
        $student->fill($request->post())->save();

        return redirect()->route('students.index')->with('success','Student Has Been updated successfully');
    }
 // Delete stident
 public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success','Student has been deleted successfully');
    }
// Create
  public function create()
  {
    return view('student.create');
  }
 
  /**
   * Show the form for editing the specified post.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
 public function edit(Student $student)
    {
        return view('student.edit',compact('student'));
    }
   
	}
 

