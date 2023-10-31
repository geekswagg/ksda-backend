<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator,Redirect,Response,File;
use App\Models\Document;
use App\Models\Folder;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\DocumentResource;

class DocumentController extends BaseController
{
    //
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST ALL RECORDS
|--------------------------------------------------------------------------
*/ 
     public function index()
        {
            $documents = Document::all();
            return $this->sendResponse(DocumentResource::collection($documents), 'Document fetched.');
        }

    /*
|--------------------------------------------------------------------------
| START OF ADD OR STORE FUNCTION
|--------------------------------------------------------------------------
*/ 
    public function store(Request $request)
        {
             $validator = Validator::make($request->all(), 
                      [ 
                    'folder_id' => 'required',                     
                      //'file' => 'required|mimes:doc,docx,pdf,txt|max:2048',
                    'file'  => 'required|mimes:png,jpg|max:2048',
                     ]);   
         
            if ($validator->fails()) {          
                    return response()->json(['error'=>$validator->errors()], 401);                        
                 }  
                   
                if ($files = $request->file('file')) {

                    //store file into document folder
                    $file = $request->file->store('public/documents');
         
                    //store your file into database
                    $document = new Document();
                    $document->title = $file;
                    $document->folder_id = $request->folder_id;
                    $document->description = $request->description;
                    $document->save();
                      
                    return response()->json([
                        "success" => true,
                        "message" => "Document successfully uploaded",
                        "file" => $file
                    ],201);
          
                }
        }
     /*
|--------------------------------------------------------------------------
| START OF SHOW FUNCTION - DISPLAYS A RECORD AT A TIME
|--------------------------------------------------------------------------
*/ 
                 public function show($id)
                    {
                        $document = Document::find($id);
                        if (is_null($document)) {
                            return $this->sendError('Document does not exist.');
                        }
                        return $this->sendResponse(new DocumentResource($document), 'Document fetched.');
                    }

     /*
|--------------------------------------------------------------------------
| START OF UPDATE FUNCTION
|--------------------------------------------------------------------------
*/ 
        public function update(Request $request, Document $document)
                {

                    //return  $request;
                     $validator = Validator::make($request->all(), 
                      [ 
                        'folder_id' => 'required',
                        'file'  => 'required|mimes:png,jpg|max:2048',
                     ]);   
         
            if ($validator->fails()) {          
                    return response()->json(['error'=>$validator->errors()], 401);                        
                 }  
                   
                if ($files = $request->file('file')) {
                     
                    //store file into document folder
                    $file = $request->file->store('public/documents');        
                    
                    $document=Document::find($request->document);

                    $document->update([

                        'title' => $file,
                        'folder_id' => $request->folder_id,
                        'description' => $request->description

                    ]);

                      
                    return response()->json([
                        "success" => true,
                        "message" => "Document successfully updated",
                        "file" => $file
                    ],201);
          
                }
            }
       /*
|--------------------------------------------------------------------------
| START OF DELETE FUNCTION
|--------------------------------------------------------------------------
*/ 
        public function destroy(Document $document)
            {
                $document->delete();
                return $this->sendResponse([], 'Document deleted.');
            }
 

    /*
|--------------------------------------------------------------------------
| START OF SEARCH
|--------------------------------------------------------------------------
*/ 
                public function search($name)
                {
                    $result = Document::where('title', 'LIKE', '%'. $name. '%')->get();
                    if(count($result)){
                     return Response()->json($result);
                    }
                    else
                    {
                    return response()->json(['Result' => 'No Data found'], 404);
                  }
                }
    /*
|--------------------------------------------------------------------------
| END
|--------------------------------------------------------------------------
*/
}
