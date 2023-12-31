<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Membershiptype;
use App\Http\Resources\Membershiptype as MembershiptypeResource;

class MembershiptypeController extends BaseController
{
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST ALL RECORDS
|--------------------------------------------------------------------------
*/ 
    public function index()
    {
        $membershiptypes = Membershiptype::all();
        return $this->sendResponse(MembershiptypeResource::collection($membershiptypes), 'Membership Types Fetched.');
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
        $membershiptype = Membershiptype::create($input);
        return $this->sendResponse(new MembershiptypeResource($membershiptype), 'Membership Type Created.');
    }
   
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO SHOW A RECORD
|--------------------------------------------------------------------------
*/ 
    public function show($id)
    {
        $membershiptype = Membershiptype::find($id);
        if (is_null($membershiptype)) {
            return $this->sendError('Membershiptype does not exist.');
        }
        return $this->sendResponse(new MembershiptypeResource($membershiptype), 'Membership Type Fetched.');
    }
    
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO UPDATE A RECORD
|--------------------------------------------------------------------------
*/ 
    public function update(Request $request, Membershiptype $membershiptype)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $membershiptype->name = $input['name'];
        $membershiptype->description = $input['description'];
        $membershiptype->save();
        
        return $this->sendResponse(new MembershiptypeResource($membershiptype), 'Membership Ttype Updated.');
    }
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO DELETE A  RECORD
|--------------------------------------------------------------------------
*/ 
    public function destroy(Membershiptype $membershiptype)
    {
        $membershiptype->delete();
        return $this->sendResponse([], 'Membership Type Deleted.');
    }
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO SEARCH A RECORD
|--------------------------------------------------------------------------
*/   
            public function search($name)
            {
                $result = Membershiptype::where('name', 'LIKE', '%'. $name. '%')->get();
                if(count($result)){
                 return Response()->json($result);
                }
                else
                {
                return response()->json(['Result' => 'No Data | not found'], 404);
              }
            }
/    /*
|--------------------------------------------------------------------------
| END
|--------------------------------------------------------------------------
*/ 
}

