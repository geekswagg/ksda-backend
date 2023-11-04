<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
        return [
            'membership_number' => $this->membership_number, 
            'user_id' => $this->user_id,
            'maritalstatus_id' => $this->maritalstatus_id ,
            'department_id' => $this->department_id , 
            'country_id' => $this->country_id ,
            'prayercell_id' => $this->prayercell_id ,
            'membershiptype_id' => $this->membershiptype_id , 
            'sex' => $this->sex ,
            'birthdate' => $this->birthdate ,
            'address' => $this->address, 
            'phone_number' => $this->phone_number,
            'join_date' => $this->join_date,
            'photo' => $this->photo ,
        ];
    }
}
