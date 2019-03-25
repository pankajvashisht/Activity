<?php 
namespace App\Repositories\User;
use App\Models\User;
use App\Repositories\User\UserInterface;
class UserRepository implements UserInterface
{
    private $model;
    public function __construct(User $model){
        $this->model = $model;
    }

    public function create(array $attributes){
        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes){
        $user = $this->model->findOrFail($id);
        return (boolean) $user->whereId($id)->update($attributes);
    }
    
    public function find($id){
        return $this->model->find($id);
    }
  
    public function findUserbyEmail(array $input){
        return $this->model->where($input)
                    ->select('email', 'first_name', 'last_name', 'id', 'password', 'access_token', 'email_verified_at',
                    'registration_step')
                    ->first();
    }
 
    public function updateAccessToken(int $id, array $attributes){
        return $this->model->whereId($id)->update($attributes);
    }

    public function findUserBySocialId($social_id){
        return $this->model->where('social_id','=',$social_id)->first();
    }
}