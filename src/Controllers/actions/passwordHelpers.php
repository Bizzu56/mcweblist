<?php
namespace Bizu\Weblistmc\controllers\actions;

class PasswordHelpers {
    public function hashPassword(string $password)
    {
        return password_hash($password, PASSWORD_ARGON2I);
    }

    public function verifyPassword(string $password, string $hashPassword)
    {
        if(password_verify($password, $hashPassword)){
            return true;
        }
        return false;
    }
}