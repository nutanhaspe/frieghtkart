<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Employee;
use Validator;

class EmployeesController extends Controller
{
    public function index(Request $request) {
        
         $employees =  Employee::orderBy('id', 'desc')->get();
         return $employees;
    }
    
    public function store(Request $request)
    {       
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:employees',
            'contact_number' => 'required|numeric',
            'profile_picture' => 'required|image|mimes:jpg,png,jpeg'
        ]);
        
        if ($validator->passes())
        {            
                $image = $request->file('profile_picture');
                
                $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

                $destinationPath = public_path('/images/uploads/');

                $image->move($destinationPath, $input['imagename']);                
                
                Employee::create(['name' => $request->name,
                    'email' => $request->email,
                    'contact_number' => $request->contact_number,
                    'profile_picture' => $input['imagename'],$request->all()]);
    
            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
        
    }
}
