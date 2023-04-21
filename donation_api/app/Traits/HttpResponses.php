<?php

namespace App\Traits;


 trait HttpResponses
{
  protected function success($data, $message='successfull request', $code = 200){
    return response()->json([
      'status'=> 'Request was successfull',
      'message'=> $message,
      'data '=> $data
    ],$code);
  }
  protected function error($data,$message= 'Bad REQUEST',$code){
    return response()->json([
      'status'=> 'Error has occurred',
      'message'=>$message,
      'data'=>$data
    ],$code);
  }
}
