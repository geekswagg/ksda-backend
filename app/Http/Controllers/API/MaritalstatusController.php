<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Maritalstatus;
use App\Http\Resources\MaritalstatusResource;

class MaritalstatusController extends BaseController
{
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST ALL RECORDS
|--------------------------------------------------------------------------
*/ 
    public function index()
    {
        $maritalstatuses = Maritalstatus::all();
        return $this->sendResponse(MaritalstatusResource::collection($maritalstatuses), 'Marital Statuses fetched.');
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
        $maritalstatuses = Maritalstatus::create($input);
        return $this->sendResponse(new MaritalstatusResource($maritalstatuses), 'Marital Status created.');
    }
   
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST A RECORD
|--------------------------------------------------------------------------
*/ 
    public function show($id)
    {
        $maritalstatuses = Maritalstatus::find($id);
        if (is_null($maritalstatuses)) {
            return $this->sendError('Marital Status does not exist.');
        }
        return $this->sendResponse(new MaritalstatusResource($maritalstatuses), 'Marital Status fetched.');
    }
    
     /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO UPDATE A RECORD
|--------------------------------------------------------------------------
*/ 
    public function update(Request $request, Maritalstatus $maritalstatuses)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $maritalstatuses->name = $input['name'];
        $maritalstatuses->save();
        
        return $this->sendResponse(new MaritalstatusResource($maritalstatuses), 'Marital Status updated.');
    }
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO DELETE A RECORD
|--------------------------------------------------------------------------
*/ 
    public function destroy(Maritalstatus $maritalstatuses)
    {
        $maritalstatuses->delete();
        return $this->sendResponse([], 'Marital Status deleted.');
    }
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO SEARCH A RECORD OR ALL RECORDS
|--------------------------------------------------------------------------
*/  
                public function search($name)
                {
                    $result = Maritalstatus::where('name', 'LIKE', '%'. $name. '%')->get();
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