<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Country;
use App\Http\Resources\Country as countryResource;
   
class CountryController extends BaseController
{
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST ALL RECORDS
|--------------------------------------------------------------------------
*/ 
    
    public function index()
    {
        $countries = Country::all();
        return $this->sendResponse(countryResource::collection($countries), 'Countries fetched.');
    }
    
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO STORE OR ADD A RECORD
|--------------------------------------------------------------------------
*/ 
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'ccode' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $country = Country::create($input);
        return $this->sendResponse(new countryResource($country), 'Country created.');
    }
   
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO DISPLAY A RECORD AT A TIME
|--------------------------------------------------------------------------
*/ 
    public function show($id)
    {
        $country = Country::find($id);
        if (is_null($country)) {
            return $this->sendError('Country does not exist.');
        }
        return $this->sendResponse(new countryResource($country), 'Country fetched.');
    }
    
    /*
|--------------------------------------------------------------------------
| START OF UPDATE FUNCTION
|--------------------------------------------------------------------------
*/ 
    public function update(Request $request, Country $country)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'ccode' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $country->name = $input['name'];
        $country->ccode = $input['ccode'];
        $country->save();
        
        return $this->sendResponse(new countryResource($country), 'Country updated.');
    }

    /*
|--------------------------------------------------------------------------
| START OF DELETE FUNCTION 
|--------------------------------------------------------------------------
*/ 
    public function destroy(Country $country)
    {
        $country->delete();
        return $this->sendResponse([], 'Country deleted.');
    }
    /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO SEARCH RECORD OR RECORDS
|--------------------------------------------------------------------------
*/   
                public function search($name)
                {
                    $result = Country::where('name', 'LIKE', '%'. $name. '%')->get();
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