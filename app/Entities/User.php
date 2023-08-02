<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    protected $attributes = [
        'id' => null,
        'name' => null,
        'email' => null,
        'password' => null,
        'verify_key' => '',
    ];

    public function setPassword(string $pass)
    {
        $this->attributes['password'] = password_hash($pass, PASSWORD_DEFAULT);

        return $this;
    }
}