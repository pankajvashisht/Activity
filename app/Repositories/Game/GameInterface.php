<?php 
namespace App\Repositories\Game;

interface GameInterface
{
    public function create(array $attributes);
    public function update(int $id, array $attributes);
    public function find(int $id);
    public function findAll();
}