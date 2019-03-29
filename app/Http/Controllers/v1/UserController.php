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
        if(!IsUcreateEmail($requestdata['email'])){
            return $this->error(406,"Email not accepted"); 
        }
        $getUser=$this->user->findUserBySocialIdAndEmail($requestdata['social_id'],$requestdata['email']);
        $success=($getUser)?$this->update($getUser):$this->store($requestdata);
        if($success){
            return $this->success($success,"Login Successfully");
        }
        return $this->error(403,"Error to Login");      
    }

    public function store($requestdata){
        $requestdata['authorization_key']=$this->genrateToken();
        if($user=$this->user->create($requestdata)){
            return $this->user->find($user->id);
        }    
        return false;
    }

    public function update($user){
        $user->authorization_key=$this->genrateToken();
        $data['authorization_key']=$user->authorization_key;
        if($this->user->update($user->id,$data)){
            return $user;
        }
        return false;
    }

    public function getUsers($user_id){
        return $this->success($this->user->findNotBookedUser($user_id),'Friends');
    }
}
