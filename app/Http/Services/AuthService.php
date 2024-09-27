<?php

namespace App\Http\Services;

use App\Models\Book;
use App\Models\User;
use App\Repositories\AuthorRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function login(array $parameters)
    {
        $user = User::where('email', $parameters['email'])->first();
        if ($user === null)
            throw new \Exception('Wrong email or password');

        if (!Hash::check($parameters['password'], $user->password))
            throw new \Exception('Wrong Password');

        auth()->login($user);
        return $user;
    }

}
