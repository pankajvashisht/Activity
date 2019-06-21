<?php 
namespace App\Repositories\User;

interface UserInterface
{
    public function create(array $attributes);
    public function update(int $id, array $attributes);
    public function find(int $id);
    public function findUserBySocialIdAndEmail(string $social_id,string $email);
    public function findUserbyEmail(array $input);
    public function findUserByAuthKe(string $input);
    public function findNotBookedUser(int $user_id);
}