<?php 

namespace App\Services;
use App\Http\Controllers\v1\ApiController;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Models\User;
class CheckAuth extends ApiController{

    protected $request;
    protected $auth_key;
    private $user;
    public function __construct(Request $request){
        $this->request = $request;
    }


    public function validateUser(){
        return $this->authRequest();
    }

    public function authRequest(){
        if(! $this->request->header('Authorization-key')){
            return $this->error(403,"Authorization-key is missing");
        }
        if($user=User::where('authorization_key','=', $this->request->header('Authorization-key'))->first()){
            $_REQUEST['user_id']=$user->id;
            return true;
        }else{
            return $this->error(401,"Invaid Authorization-key");
        }    
    }
    

}