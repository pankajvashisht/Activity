<?php 
namespace App\Repositories\Game;
use App\Models\Game;
use App\Repositories\Game\GameInterface;
class GameRepository implements GameInterface
{
    private $model;
    public function __construct(Game $model){
        $this->model = $model;
    }

    public function create(array $attributes){
        return $this->model->create($attributes);
    }
    
    public function add(array $attributes){
        return $this->model->insert($attributes);
    }

    public function update(int $id, array $attributes){
        $user = $this->model->findOrFail($id);
        return (boolean) $user->whereId($id)->update($attributes);
    }
    
    public function find($id){
        return $this->model->find($id);
    }
    public function findAll(){
        return $this->model->get();
    }
}