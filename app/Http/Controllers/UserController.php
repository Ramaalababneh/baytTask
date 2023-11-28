<?php

namespace App\Http\Controllers;

use Auth;

use App\Models\User;
use App\Models\Student;
use App\DataTables\UsersDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function index(UsersDataTable $dataTables)
    {
        return $dataTables->render('admin.pages.users.index');
    }
    public function dashIndex()
    {
        // if (Auth::id()) {
        //     $role = Auth()->user()->role;}
        //         if ($role == 'admin') {
                return view('admin.index');
            // }
            // else
            // {$student = Student::all();
            // return view('index', compact('student'));}

    }

    
    public function create()
    {
        return view('admin.pages.users.create');
    }


    public function store(Request $request)
    {

        // Data Validate
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]+$/',
                'max:255',], 
            'role' => ['required'],
        ]);


        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), // Hashing the password
            'role' => $request->input('role'),
        ]);

        $notification = array(
            'message' => 'User Created Successfully!!',
            'alert-type' => 'success',
        );

        return redirect()->route('users.index')->with($notification);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pages.users.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
        // Data Validate
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'role' => ['required'],
        ]);

        $data = $request->except(['_token', '_method']);

        User::where('id', $id)->update($data);

        $notification = array(
            'message' => 'User Updated Successfully!!',
            'alert-type' => 'success',
        );

        return redirect()->route('users.index')->with($notification);
    }


    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();


            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            Log::error("Error deleting project: {$e->getMessage()}");
            return response(['status' => 'error', 'message' => 'Failed']);
        }
    }
}
