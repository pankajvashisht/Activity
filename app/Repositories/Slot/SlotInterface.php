<?php 
namespace App\Repositories\Slot;

interface SlotInterface
{
    public function create(array $attributes);
    public function update(int $id, array $attributes);
    public function find(int $id);
    public function findAll();
    public function findByDateAndGame(int $game_id,int $date);
}