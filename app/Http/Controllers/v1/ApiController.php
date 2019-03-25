<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;   

class ApiController extends Controller
{

    private $error_response=[
         'code' => 403 ,
         'success' => false,
         'error_message'  => 'error message'
    ];

    private $success_responce=[
        'code' => 200 ,
        'success' => true,
        'message'  => 'no message',
        'body' => []
    ];


    private  function createResponce(int $status=200 , string $meessage='',$data=[]){
        return ($status>=200 && $status<=299)?$this->setSuccess($meessage,$status,$data):$this->setError($meessage,$status);
    }

    public function success($data=[],int $status=200,string $message=''){
            $this->createResponcecreateResponce($status,$message,$data);
            return new JsonResponse($this->success_responce, $status);
    }

    public function error(int $status=403,string $message=''){
        if($status==400){
            $message=self::badRequestMessage($message);
        }
        $this->createResponce($status,$message);
        return new JsonResponse($this->error_response, $status);
        
    }

    private static function badRequestMessage($error){
        $error=json_decode($error,true);
        $final=[];
        foreach($error as $key => $val){
            $final[$key]=implode(',',$val);
        }
        return implode(',',$final);
    }

    private function setSuccess(string $meessage,int $status,$body){
        $this->success_responce['message']=$meessage;
        $this->success_responce['code']=$status;
        $this->success_responce['body']=$body;
        return $this;
    }

    private function setError(string $meessage,int $status){
        $this->error_response['error_message']=$meessage;
        $this->error_response['code']=$status;
        return $this;
    }

    public function genrateToken(){
        return sha1(md5(time()));
    }

}
