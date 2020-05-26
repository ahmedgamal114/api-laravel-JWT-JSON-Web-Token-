<?php

namespace App\Http\Controllers;
use App\Http\Controllers\controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Hash;
use App\User;
use JWTFactory;
use JWTAuth;
use Vaildator;
use Response;



class ApiLoginController extends Controller
{
    //
    
    public function login( Request $request){
        $validator = Validator::make($request-> all(),[
         'email' => 'required|string|email|max:255',
         'password'=> 'required'
        ]);

        if ($validator -> fails()) {
            # code...
            return response()->json($validator->errors());
            
        }


    
       

        $credentials = $request->only('email','password');
            
      
        try{
            if (! $token = JWTAuth::attempt( $credentials) ) {
                # code...
                return response()->json( ['error'=> 'invalid userkname and password'],401);
            }
        }catch(JWTException $e){

          return response()->json( ['error'=> 'could not create token'],500);
        }


        return response()->json( compact('token'));
    }
}
