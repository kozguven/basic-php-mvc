<?php

class Validation
{
    public static function sanitize($data)
    {
        return htmlspecialchars(strip_tags($data));
    }

    public static function validateUsername($username)
    {
        if (preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
            return true;
        } else {
            return false;
        }
    }

    public static function validatePassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        } else {
            return false;
        }
    }
}