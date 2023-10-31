<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Position;
use App\Http\Resources\Position as PositionResource;

class PositionController extends BaseController
{
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST ALL RECORDS
|--------------------------------------------------------------------------
*/ 
    public function index()
    {
        $positions = Position::all();
        return $this->sendResponse(PositionResource::collection($positions), 'positions fetched.');
    }
    
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO ADD OR STORE A RECORD
|--------------------------------------------------------------------------
*/ 
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
   
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST A RECORD
|--------------------------------------------------------------------------
*/ 
    public function show($id)
    {
        $position = Position::find($id);
        if (is_null($position)) {
            return $this->sendError('Position does not exist.');
        }
        return $this->sendResponse(new PositionResource($position), 'Position fetched.');
    }
    
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO UPDATE A RECORD
|--------------------------------------------------------------------------
*/ 
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
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO DELETE A RECORD
|--------------------------------------------------------------------------
*/ 
    public function destroy(Position $position)
    {
        $position->delete();
        return $this->sendResponse([], 'Position deleted.');
    }
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO SEARCH A RECORD OR ALL RECORDS
|--------------------------------------------------------------------------
*/   
                public function search($name)
                {
                    $result = Position::where('name', 'LIKE', '%'. $name. '%')->get();
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

