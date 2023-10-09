<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Position;
use App\Http\Resources\Position as PositionResource;

class PositionController extends BaseController
{
   //
     #START OF FUNCTION TO LIST ALL RECORDS
    public function index()
    {
        $positions = Position::all();
        return $this->sendResponse(PositionResource::collection($positions), 'positions fetched.');
    }
    
    #END
    #START OF FUNCTION TO ADD | STORE A RECORD
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $position = Position::create($input);
        return $this->sendResponse(new PositionResource($position), 'Position created.');
    }
   
   #END
   #START OF FUNCTION TO SHOW A RECORD
    public function show($id)
    {
        $position = Position::find($id);
        if (is_null($position)) {
            return $this->sendError('Position does not exist.');
        }
        return $this->sendResponse(new PositionResource($position), 'Position fetched.');
    }
    
    #END
    #START OF FUNCTION TO EDIT | UPDATE
    public function update(Request $request, Position $position)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $position->name = $input['name'];
        $position->description = $input['description'];
        $position->save();
        
        return $this->sendResponse(new PositionResource($position), 'Position updated.');
    }
    #END
   
   #START OF FUNCTION TO DELETE
    public function destroy(Position $position)
    {
        $position->delete();
        return $this->sendResponse([], 'Position deleted.');
    }
    #END
}

