<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Country;
use App\Http\Resources\Country as countryResource;
   
class CountryController extends BaseController
{
    #START OF FUNCTION TO LIST ALL RECORDS
    public function index()
    {
        $countries = Country::all();
        return $this->sendResponse(countryResource::collection($countries), 'Countries fetched.');
    }
    
    #END
    #START OF FUNCTION TO ADD | STORE A RECORD
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
   
   #END
   #START OF FUNCTION TO SHOW A RECORD
    public function show($id)
    {
        $country = Country::find($id);
        if (is_null($country)) {
            return $this->sendError('Country does not exist.');
        }
        return $this->sendResponse(new countryResource($country), 'Country fetched.');
    }
    
    #END
    #START OF FUNCTION TO EDIT | UPDATE
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
    #END
   
   #START OF FUNCTION TO DELETE
    public function destroy(Country $country)
    {
        $country->delete();
        return $this->sendResponse([], 'Country deleted.');
    }
    #END
}