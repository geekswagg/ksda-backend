<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator,Redirect,Response,File;
use App\Models\Member;
use App\Models\User;
use App\Models\Department;
use App\Models\Maritalstatus;
use App\Models\Membershiptype;
use App\Models\Prayercells;
use App\Models\Country;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\MemberResource;

class MemberController extends BaseController
{
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST ALL RECORDS
|--------------------------------------------------------------------------
*/ 
     public function index()
        {
            $members = Member::all();
            $total = $members->count();
           
            return response()->json([
            'data' => $members,
            'total members' =>$total,
            'message' => 'Members Data Fetched Successfully'],200);
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
                        'user_id' => 'required',  
                        'membership_number' => 'required', 
                        'maritalstatus_id' => 'required', 
                        'department_id' => 'required', 
                        'country_id' => 'required', 
                        'prayercell_id' => 'required', 
                        'membershiptype_id' => 'required', 
                        'sex' => 'required', 
                        //'birthdate' => 'required', 
                       // 'address' => 'required', 
                       // 'phone_number' => 'required', 
                        'join_date' => 'required',                  
                          //'file' => 'required|mimes:doc,docx,pdf,txt|max:2048',
                        'file'  => 'required|mimes:png,jpg|max:2048',
                     ]);   
         
            if ($validator->fails()) {          
                    return response()->json(['error'=>$validator->errors()], 401);                        
                 }  
                   
                if ($files = $request->file('file')) {

                    //store file into images folder
                    $file = $request->file->store('public/images');
         
                    //store your file into database
                    $member = new Member();
                    $member->photo = $file;
                    $member->user_id = $request->user_id;
                    $member->membership_number = $request->membership_number;
                    $member->maritalstatus_id = $request->maritalstatus_id;
                    $member->department_id = $request->department_id;
                    $member->country_id = $request->country_id;
                    $member->prayercell_id = $request->prayercell_id;
                    $member->membershiptype_id = $request->membershiptype_id;
                    $member->sex = $request->sex;
                    $member->birthdate = $request->birthdate;
                    $member->address = $request->address;
                    $member->phone_number = $request->phone_number;
                    $member->join_date = $request->join_date;
                    $member->save();
                      
                    return response()->json([
                        "success" => true,
                        "message" => "Member Created Successfully",
                        "file" => $file
                    ],201);
          
                }
        }
 

     /*
|--------------------------------------------------------------------------
| START OF UPDATE FUNCTION
|--------------------------------------------------------------------------
*/ 
        public function update(Request $request, Member $member)
                {

                    //return  $request;
                     $validator = Validator::make($request->all(), 
                      [ 
                        'user_id' => 'required',  
                        'membership_number' => 'required', 
                        'maritalstatus_id' => 'required', 
                        'department_id' => 'required', 
                        'country_id' => 'required', 
                        'prayercell_id' => 'required', 
                        'membershiptype_id' => 'required', 
                        'sex' => 'required', 
                        //'birthdate' => 'required', 
                        //'address' => 'required', 
                        //'phone_number' => 'required', 
                        'join_date' => 'required',                  
                         'file'  => 'required|mimes:png,jpg|max:2048',
                     ]);   
         
            if ($validator->fails()) {          
                    return response()->json(['error'=>$validator->errors()], 401);                        
                 }  
                   
                if ($files = $request->file('file')) {
                     
                    //store file into member folder
                    $file = $request->file->store('public/images');        
                    
                    $member=Member::find($request->member);

                    $member->update([
                        'photo' => $file,
                        'user_id' => $request->user_id,
                        'membership_number' => $request->membership_number,
                        'maritalstatus_id' => $request->maritalstatus_id,
                        'department_id' => $request->department_id,
                        'country_id' => $request->country_id,
                        'prayercell_id' => $request->prayercell_id,
                        'membershiptype_id' => $request->membershiptype_id,
                        'sex' => $request->sex,
                        'birthdate' => $request->birthdate,
                        'address' => $request->address,
                        'phone_number' => $request->phone_number,
                        'join_date' => $request->join_date

                    ]);

                      
                    return response()->json([
                        "success" => true,
                        "message" => "Member successfully updated",
                        "file" => $file
                    ],201);
          
                }
            }
       /*
|--------------------------------------------------------------------------
| START OF DELETE FUNCTION
|--------------------------------------------------------------------------
*/ 
        public function destroy(Member $member)
            {
                $member->delete();
                return $this->sendResponse([], 'Member successfully deleted.');
            }
 

    /*
|--------------------------------------------------------------------------
| START OF SEARCH
|--------------------------------------------------------------------------
*/ 
                public function search($name)
                {
                    $result = Member::where('membership_number', 'LIKE', '%'. $name. '%')->get();
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
