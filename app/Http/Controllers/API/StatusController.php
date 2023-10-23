<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Status;
use App\Http\Resources\Status as statusResource;

class StatusController extends BaseController
{
    #START OF FUNCTION TO LIST ALL RECORDS
    public function index()
    {
        $statuses = Status::all();
        return $this->sendResponse(StatusResource::collection($statuses), 'Statuses fetched.');
    }
    
    #END
    #START OF FUNCTION TO ADD | STORE A RECORD
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
   
   #END
   #START OF FUNCTION TO SHOW A RECORD
    public function show($id)
    {
        $status = Status::find($id);
        if (is_null($status)) {
            return $this->sendError('Status does not exist.');
        }
        return $this->sendResponse(new StatusResource($status), 'Status fetched.');
    }
    
    #END
    #START OF FUNCTION TO EDIT | UPDATE
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
    #END
   
   #START OF FUNCTION TO DELETE
    public function destroy(Status $status)
    {
        $status->delete();
        return $this->sendResponse([], 'Status deleted.');
    }
    #END
}