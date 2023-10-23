<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Folder;
use App\Http\Resources\Folder as FolderResource;

class FolderController extends BaseController
{
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST ALL RECORDS
|--------------------------------------------------------------------------
*/ 
    public function index()
    {
        $folders = Folder::all();
        return $this->sendResponse(FolderResource::collection($folders), 'Folders fetched.');
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
            'name' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $folder = Folder::create($input);
        return $this->sendResponse(new FolderResource($folder), 'Folder created.');
    }
   
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST A RECORD
|--------------------------------------------------------------------------
*/ 
    public function show($id)
    {
        $folder = Folder::find($id);
        if (is_null($folder)) {
            return $this->sendError('Folder does not exist.');
        }
        return $this->sendResponse(new FolderResource($folder), 'Folder fetched.');
    }
    
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO UPDATE A RECORD
|--------------------------------------------------------------------------
*/ 
    public function update(Request $request, Folder $folder)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $folder->name = $input['name'];
        $folder->save();
        
        return $this->sendResponse(new FolderResource($folder), 'Folder updated.');
    }
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO DELETE A RECORD
|--------------------------------------------------------------------------
*/ 
    public function destroy(Folder $folder)
    {
        $folder->delete();
        return $this->sendResponse([], 'Folder deleted.');
    }
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST A RECORD OR ALL RECORDS
|--------------------------------------------------------------------------
*/  
                public function search($name)
                {
                    $result = Folder::where('name', 'LIKE', '%'. $name. '%')->get();
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