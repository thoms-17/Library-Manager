<?php

namespace App\Utils;

class SecurePassword
{
    public static function isPasswordSecure($password): bool
    {
        // Vérifie : au moins 8 caractères, une majuscule, un chiffre, et un caractère spécial
        return preg_match('/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_])(?=.{8,})/', $password);
    }
}
