<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Book;
use Vaildator;

class BookController extends BaseController
{
    //
    function index(){
  $book =Book::all();
  return $this->sendResponse($book->ToArray(),'Book Read Successfully');
    }

    public function store(Request $request){
      $input=$request->all();
      $validator = Validator::make($input,[
     'name'=>'required|string|max:255',
     'details'=>'required'  ]);
     if($validator->fails())
      { return $this->sendError('error Validation',$validator->errors());}
        $book =Book::create($input);
        return $this->sendResponse($book->toArray(),'Book Create successfully');
    }





    public function update(Request $request,Book $book){
        $input=$request->all();
        $validator = Validator::make($input,[
       'name'=>'required|string|max:255',
       'details'=>'required'  ]);
       if($validator->fails())
        { return $this->sendError('error Validation',$validator->errors());}



          $book->name =$input['name'];
          $book->details=$input['details'];
          $book->save();
          return $this->sendResponse($book->toArray(),'Book Create successfully');
      }


    public function show( $id){
        $book =Book::find($id);
   
       if(is_null($book))
        { return $this->sendError('book Not Found');}
         ;
          return $this->sendResponse($book->toArray(),'Book read and show successfully');
      }
  
  


      public function destroy(Book $book){
      
          $book->delete();
          return $this->sendResponse($book->toArray(),'Book Delete successfully');
      }










}
