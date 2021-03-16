<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //

     protected $fillable = [
        'name', 'address', 'latitude', 'longitude', 'user_id', 'status'
    ];

    protected function insertAddress($name = '', $address = '', $latitude = '', $longitude = '', $userId = '') {

        $InAry = [
            'name' => $name,
            'address' => $address,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'user_id' => $userId,
            'status' => '1'
        ];

        $Address = $this->create($InAry);
        return $Address->id;
    }

    protected function getAddressById($id=''){

        $Address = $this->where('user_id', $id)->get();

        if(count($Address) > 0){

           return $Address;
    
        }   
        
        return false;
    }

    protected function getAddress(){

        $Status = 1;

        $Address = $this->where('status', $Status)->get();

        if(count($Address) > 0){

           return $Address;
    
        }   
        
        return false;
    }

    protected function updateAddress($id = '', $name = '', $address = '', $latitude = '', $longitude = '') {

        $Address = $this->where('id', $id)->first();

        if ($Address) {

            $UpAry = [
                'name' => $name,
                'address' => $address,
                'latitude' => $latitude,
                'longitude' => $longitude
            ];
        }

        $this->where('id', $id)->update($UpAry);

        return $Address->id;
    }

    protected function changeAddressStatus($id = '') {

        $Address = $this->where('id', $id)->first();

        if ($Address) {

            $Status = 0;

            if ($Address->status == 0) {

                $Status = 1;
            }

            $this->where('id', $id)->update(['status' => $Status]);

            return $Status;
        }
    }
}
