<?php

namespace App\Http\Controllers\API;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Folder;
use App\Http\Resources\Folder as FolderResource;

class FolderController extends BaseController
{
    #START OF FUNCTION TO LIST ALL RECORDS
    public function index()
    {
        $folders = Folder::all();
        return $this->sendResponse(FolderResource::collection($folders), 'Folders fetched.');
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
        $folder = Folder::create($input);
        return $this->sendResponse(new FolderResource($folder), 'Folder created.');
    }
   
   #END
   #START OF FUNCTION TO SHOW A RECORD
    public function show($id)
    {
        $folder = Folder::find($id);
        if (is_null($folder)) {
            return $this->sendError('Folder does not exist.');
        }
        return $this->sendResponse(new FolderResource($folder), 'Folder fetched.');
    }
    
    #END
    #START OF FUNCTION TO EDIT | UPDATE
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
    #END
   
   #START OF FUNCTION TO DELETE
    public function destroy(Folder $folder)
    {
        $folder->delete();
        return $this->sendResponse([], 'Folder deleted.');
    }
    #END
}