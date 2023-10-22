<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Paymentmode;
use App\Http\Resources\Paymentmode as PaymentmodeResource;

class PaymentmodeController extends BaseController
{
    //
     #START OF FUNCTION TO LIST ALL RECORDS
    public function index()
    {
        $paymentmodes = Paymentmode::all();
        return $this->sendResponse(PaymentmodeResource::collection($paymentmodes), 'Payment Mode Fetched.');
    }
    
    #END
    #START OF FUNCTION TO ADD | STORE A RECORD
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
        $paymentmode = Paymentmode::create($input);
        return $this->sendResponse(new PaymentmodeResource($paymentmode), 'Payment Mode Created.');
    }
   
   #END
   #START OF FUNCTION TO SHOW A RECORD
    public function show($id)
    {
        $paymentmode = Paymentmode::find($id);
        if (is_null($paymentmode)) {
            return $this->sendError('Payment Mode does not exist.');
        }
        return $this->sendResponse(new PaymentmodeResource($paymentmode), 'Payment Mode Fetched.');
    }
    
    #END
    #START OF FUNCTION TO EDIT | UPDATE
    public function update(Request $request, Paymentmode $paymentmode)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $paymentmode->name = $input['name'];
        $paymentmode->description = $input['description'];
        $paymentmode->save();
        
        return $this->sendResponse(new PaymentmodeResource($paymentmode), 'Payment Mode Updated.');
    }
    #END
   
   #START OF FUNCTION TO DELETE
    public function destroy(Paymentmode $paymentmode)
    {
        $paymentmode->delete();
        return $this->sendResponse([], 'Payment Mode Deleted.');
    }
    #END


    #START SEARCH
    public function searchpaymentmode(Request $request)
        {
            $search = request()->get('search');

            $paymentmodes = Paymentmode::where('name', 'LIKE', "%{$search}%")->Paginate(10);            
            
            return Response::json(array('paymentmodes' => $paymentmodes));

        }

        #END SEARCH
}

