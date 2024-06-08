<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserModel extends Eloquent
{
    protected $table = 'users';
    protected $fillable = ['username', 'password'];

    public $timestamps = false;

    public function register($username, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        return $this->create([
            'username' => $username,
            'password' => $hashedPassword,
        ]);
    }

    public function login($username, $password)
    {
        $user = $this->where('username', $username)->first();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return false;
    }

    public function getUserById($id)
    {
        return $this->find($id);
    }
}