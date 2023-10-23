<?php

namespace App\Http\Controllers\API;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Department;
use App\Http\Resources\Department as DepartmentResource;

class DepartmentController extends BaseController
{
    #START OF FUNCTION TO LIST ALL RECORDS
    public function index()
    {
        $departments = Department::all();
        return $this->sendResponse(DepartmentResource::collection($departments), 'departments fetched.');
    }
    
    #END
    #START OF FUNCTION TO ADD | STORE A RECORD
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'dcode' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $department = Department::create($input);
        return $this->sendResponse(new DepartmentResource($department), 'Department created.');
    }
   
   #END
   #START OF FUNCTION TO SHOW A RECORD
    public function show($id)
    {
        $department = Department::find($id);
        if (is_null($department)) {
            return $this->sendError('Department does not exist.');
        }
        return $this->sendResponse(new DepartmentResource($department), 'Department fetched.');
    }
    
    #END
    #START OF FUNCTION TO EDIT | UPDATE
    public function update(Request $request, Department $department)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'dcode' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $department->name = $input['name'];
        $department->dcode = $input['dcode'];
        $department->save();
        
        return $this->sendResponse(new DepartmentResource($department), 'Department updated.');
    }
    #END
   
   #START OF FUNCTION TO DELETE
    public function destroy(Department $department)
    {
        $department->delete();
        return $this->sendResponse([], 'Department deleted.');
    }
    #END
}