<?php

namespace App\Services;

use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class AuthService
{

    protected $userRepository;

    public function __construct(User $user){
        $this->userRepository = $user;
    }

    public function getAll(): Collection
    {
        return $this->userRepository->all();
    }

    public function find(string $id): User
    {
        $user = $this->checkUserExists->($id);
       
        return $user;
    }

    public function create(array $data): User
    {
        return $this->userRepository->create($data);
    }



    
    protected function checkUserExists(int $userId): User
    {
        $user = $this->userRepository->find($userId);
        if(!$user){
            throw new UserNotFoundException();
        }
        return $user
    }
}