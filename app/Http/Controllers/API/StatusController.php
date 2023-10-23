<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Status;
use App\Http\Resources\Status as statusResource;

class StatusController extends BaseController
{
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST ALL RECORDS
|--------------------------------------------------------------------------
*/ 
    public function index()
    {
        $statuses = Status::all();
        return $this->sendResponse(StatusResource::collection($statuses), 'Statuses fetched.');
    }
    
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO STORE A RECORD
|--------------------------------------------------------------------------
*/ 
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $status = Status::create($input);
        return $this->sendResponse(new StatusResource($status), 'Status created.');
    }
   
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST A RECORD
|--------------------------------------------------------------------------
*/ 
    public function show($id)
    {
        $status = Status::find($id);
        if (is_null($status)) {
            return $this->sendError('Status does not exist.');
        }
        return $this->sendResponse(new StatusResource($status), 'Status fetched.');
    }
    
     /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO UPDATE A RECORD
|--------------------------------------------------------------------------
*/ 
    public function update(Request $request, Status $status)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $status->name = $input['name'];
        $status->save();
        
        return $this->sendResponse(new StatusResource($status), 'Status updated.');
    }
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO DELETE A RECORD
|--------------------------------------------------------------------------
*/ 
    public function destroy(Status $status)
    {
        $status->delete();
        return $this->sendResponse([], 'Status deleted.');
    }
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO SEARCH A RECORD OR ALL RECORDS
|--------------------------------------------------------------------------
*/  
                public function search($name)
                {
                    $result = Status::where('name', 'LIKE', '%'. $name. '%')->get();
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