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
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST ALL RECORDS
|--------------------------------------------------------------------------
*/ 
    public function index()
    {
        $departments = Department::all();
        return $this->sendResponse(DepartmentResource::collection($departments), 'departments fetched.');
    }
    
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO ADD OR STORE RECORD
|--------------------------------------------------------------------------
*/ 
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
   
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST A RECORD AT A TIME
|--------------------------------------------------------------------------
*/ 
    public function show($id)
    {
        $department = Department::find($id);
        if (is_null($department)) {
            return $this->sendError('Department does not exist.');
        }
        return $this->sendResponse(new DepartmentResource($department), 'Department fetched.');
    }
    
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO UPDATE A RECORD
|--------------------------------------------------------------------------
*/ 
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
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO DELETE A RECORD
|--------------------------------------------------------------------------
*/ 
    public function destroy(Department $department)
    {
        $department->delete();
        return $this->sendResponse([], 'Department deleted.');
    }
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO SEARCH A RECORD OR ALL RECORDS
|--------------------------------------------------------------------------
*/  
                public function search($name)
                {
                    $result = Department::where('name', 'LIKE', '%'. $name. '%')->get();
                    if(count($result)){
                     return Response()->json($result);
                    }
                    else
                    {
                    return response()->json(['Result' => 'No Data | not found'], 404);
                  }
                }
        /*
|--------------------------------------------------------------------------
| END
|--------------------------------------------------------------------------
*/ 
}