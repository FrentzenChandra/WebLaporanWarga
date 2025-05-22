<?php
namespace App\Interfaces;

interface AuthRepositoryInterface
{
    public function login(array $credentials);
    public function logout();
    // public function register(array $data);
    // public function getUserById($id);
    // public function updateUser($id, array $data);
    // public function deleteUser($id);
    // public function getAllUsers();
    // public function getUserByEmail($email);
}