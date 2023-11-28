<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Student;
use App\DataTables\StudentsDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{

    public function index(StudentsDataTable $dataTables)
    {
        return $dataTables->render('admin.pages.student.index');
    }

    public function showAllStudents()
    {
        $student = Student::all();
        return view('index', compact('student'));
    }

    public function create()
    {
        return view('admin.pages.student.create');
    }


    public function store(Request $request)
    {

        // Data Validate
        $request->validate([
            'name' => ['required', 'string', 'max:255'], // Assuming 'name' should be a string with a maximum length of 255 characters.
            'age' => ['required', 'integer', 'min:1'], // Assuming 'age' should be an integer greater than or equal to 1.
            'residence_location' => ['required', 'string', 'max:255'], // Assuming 'residence_location' should be a string with a maximum length of 255 characters.
        ]);

        Student::create([
            'name' => $request->input('name'),
            'age' => $request->input('age'),        
            'residence_location' => $request->input('residence_location'),
        ]);

        $notification = array(
            'message' => 'Students Created Successfully!!',
            'alert-type' => 'success',
        );

        return redirect()->route('students.index')->with($notification);
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.pages.student.edit', compact('student'));
    }


    public function update(Request $request, $id)
    {
        // Data Validate
        $request->validate([
            'name' => ['required', 'string', 'max:255'], // Assuming 'name' should be a string with a maximum length of 255 characters.
            'age' => ['required', 'integer', 'min:1'], // Assuming 'age' should be an integer greater than or equal to 1.
            'residence_location' => ['required', 'string', 'max:255'], // Assuming 'residence_location' should be a string with a maximum length of 255 characters.
        ]);

        $data = $request->except(['_token', '_method']);

        $student = Student::findOrFail($id);

        Student::where('id', $id)->update($data);

        $notification = array(
            'message' => 'Student Updated Successfully!!',
            'alert-type' => 'success',
        );

        return redirect()->route('students.index')->with($notification);
    }


    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();


            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            Log::error("Error deleting project: {$e->getMessage()}");
            return response(['status' => 'error', 'message' => 'Failed']);
        }
    }
}