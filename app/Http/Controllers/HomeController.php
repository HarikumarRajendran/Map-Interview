<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Address;
use Validator;


class HomeController extends Controller
{
        public function getUserLogin(){

        if (request()->session()->has('UsrId'))
        {

            return redirect()->route('get-user-index');

        }
        else
        {

            return view('Login');
        }
    }

    public function postCreateUser(){

    	$validator = Validator::make(request()->all() , ['name' => 'required', 'email' => 'required|email|unique:users', 'password' => 'required']);

    	if ($validator->fails()){

            $Success = false;
	        $Data['Success'] = $Success;
	        $Data['Error']   = 'Something went wrong!!';
        
        } else{

        	$name = request()->input('name');
	        $email = request()->input('email');
	        $pwd = request()->input('password');
	        $password = md5($pwd);
	        $Success = false;

	        $User = User::createUser($name, $email, $password);

	        if ($User)
	        {

	            $Success = true;

	            $Data['Success'] = $Success;

	        }
	    }

	    return response()->json($Data);
    }

    public function postUserLogin(){

        $validator = Validator::make(request()->all() , ['email' => 'required', 'password' => 'required']);

        if ($validator->fails())
        {

            return redirect()->back()->with('ErrMsg', 'Invalid Credentials');
        }
        else
        {

            $usrNm = request()->input('email');
            $pwd = request()->input('password');
            $password = md5($pwd);
            $Success = false;
            $AuthKey = false;

            $chkUsr = User::checkLogin($usrNm, $password);

            if ($chkUsr)
            {

                request()->session()->put('UsrId', $chkUsr->id);

                return redirect()->route('get-user-index');

            }
            else
            {

                return redirect()->back()->with('ErrMsg', 'Invalid Credentials');
            }

        }
    }

    public function getUserIndex(){

        if (!request()->session()->has('UsrId'))
        {

            return redirect()->route('get-user-login');

        }
        else
        {
        	$UserId = request()->session()->get('UsrId');
        	
        	$Data['AddressInfo'] = Address::getAddressById($UserId);

            return view('Index')->with($Data);
        }
    }

    public function postAddAddress(){

     	$Success = false;

     	if (!request()->session()->has('UsrId'))
        {

            return redirect()->route('get-user-login');

        }else{

	     	$validator = Validator::make(request()->all() , ['locationName' => 'required', 'address' => 'required', 'latitude' => 'required', 'longitude' => 'required']);

	        if ($validator->fails())
	        {
	        	$Data['Success'] = $Success;
	        	$Data['Error']   = 'Something went wrong!!';
	        }
	        else
	        {

		        $name = request()->input('locationName');
		        $address = request()->input('address');
		        $latitude = request()->input('latitude');
		        $longitude = request()->input('longitude');
		        $UserId = request()->session()->get('UsrId');

		        $Address = Address::insertAddress($name, $address, $latitude, $longitude, $UserId);

		        if ($Address)
		        {

		            $Data['AddressInfo'] = Address::getAddressById($UserId);
		            $Data['Msg'] = 'Added Successfully';
		            $Success = true;

		        }

		        $Data['Success'] = $Success;
		        return response()->json($Data);
		    }
		}
    }

    public function postUpdateAddress(){

        $Success = false;

        if (!request()->session()->has('UsrId'))
        {

            return redirect()->route('get-user-login');
        }
        else
        {

            $id = request()->input('id');
            $name = request()->input('locationName');
		    $address = request()->input('address');
		    $latitude = request()->input('latitude');
		    $longitude = request()->input('longitude');
		    $UserId = request()->session()->get('UsrId');

            $Address = Address::updateAddress($id, $name, $address, $latitude, $longitude);

            if ($Address)
            {

                $Data['AddressInfo'] = Address::getAddressById($UserId);
                $Data['Msg'] = 'Updated Successfully';
                $Success = true;
            }

        }

        $Data['Success'] = $Success;
        return response()->json($Data);
    }

    public function postStatusAddress(){

        $Success = false;

        if (!request()->session()->has('UsrId'))
        {

            return redirect()->route('get-user-login');

        }
        else
        {

            $id = request()->input('ActId');
            $Data['Status'] = Address::changeAddressStatus($id);
            $Data['Msg'] = 'Updated Successfully';
            $Success = true;
        }

        $Data['Success'] = $Success;
        return response()->json($Data);
    }

    public function postViewMap(){

        if (!request()->session()->has('UsrId'))
        {

            return redirect()->route('get-user-login');

        }
        else
        {
        	$UserId = request()->session()->get('UsrId');
        	
        	$Data['AddressInfo'] = Address::all()->where('status','1')->where('user_id', $UserId);

            return response()->json($Data);
        }
    }

    public function getUserLogout(){

	    if(!request()->session()->has('UsrId')){

	        return redirect()->route('get-user-login');
	    }else{

	        request()->session()->forget('UsrId');
	        return redirect()->route('get-user-login');
	    }
	}
}
