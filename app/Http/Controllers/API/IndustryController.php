<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Industry;
use App\Http\Resources\Industry as IndustryResource;

class IndustryController extends BaseController
{
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST ALL RECORDS
|--------------------------------------------------------------------------
*/ 
    public function index()
    {
        $industries = Industry::all();
        return $this->sendResponse(IndustryResource::collection($industries), 'industries fetched.');
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
        $industry = Industry::create($input);
        return $this->sendResponse(new IndustryResource($industry), 'Industry created.');
    }
   
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST A RECORD
|--------------------------------------------------------------------------
*/ 
    public function show($id)
    {
        $industry = Industry::find($id);
        if (is_null($industry)) {
            return $this->sendError('Industry does not exist.');
        }
        return $this->sendResponse(new IndustryResource($industry), 'Industry fetched.');
    }
    
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO UPDATE A RECORD
|--------------------------------------------------------------------------
*/ 
    public function update(Request $request, Industry $industry)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $industry->name = $input['name'];
        $industry->description = $input['description'];
        $industry->save();
        
        return $this->sendResponse(new IndustryResource($industry), 'Industry updated.');
    }
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO DELETE A RECORD
|--------------------------------------------------------------------------
*/ 
    public function destroy(Industry $industry)
    {
        $industry->delete();
        return $this->sendResponse([], 'Industry deleted.');
    }
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO SEARCH A RECORD OR ALL RECORDS
|--------------------------------------------------------------------------
*/   
                public function search($name)
                {
                    $result = Industry::where('name', 'LIKE', '%'. $name. '%')->get();
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

