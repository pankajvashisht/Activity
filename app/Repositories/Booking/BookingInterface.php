<?php 
namespace App\Repositories\Booking;

interface BookingInterface
{
    public function create(array $attributes);
    public function update(int $id, array $attributes);
    public function find(int $id);
    public function findAll();
    public function findByUserId(int $user_id);
    public function addMember(array $bookingUser);
    public function checkSlot(int $slot_id,int $game_id,int $date);
    public function findMemberStatus(array $users);
    public function userBookings(int $user_id);
    public function AllBookings();
}