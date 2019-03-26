<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\v1\ApiController;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Validator;

class UserController extends ApiController
{
 
    private $user;
    public function __construct(UserRepository $user){
        $this->user = $user;
    }

    public function userLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required|string|max:50',
            'social_token' => 'required',
            'social_id' => 'required'
        ]);
        if ($validator->fails()) {
             return $this->error(400,$validator->messages());
        }
        $requestdata=$request->all();

        $getUser=$this->user->findUserBySocialId($requestdata['social_id']);
        $success=($getUser)?$this->update($getUser):$this->store($requestdata);
        if($success){
            return $this->success($success,"Login Successfully");
        }
        return $this->error(403,"Error to Login");      
    }

    public function store($requestdata){
        $requestdata['authorization_key']=$this->genrateToken();
        return $this->user->create($requestdata);    
    }

    public function update($user){
        $user->authorization_key=$this->genrateToken();
        $data['authorization_key']=$user->authorization_key;
        if($this->user->update($user->id,$data)){
            return $user;
        }
        return false;
    }
}
