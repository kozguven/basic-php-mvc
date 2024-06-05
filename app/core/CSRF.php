<?php

class CSRF
{/**
 * Generates a CSRF token and stores it in the session.
 *
 * This function checks if a session has been started and starts one if it hasn't.
 * It then checks if a CSRF token exists in the session and generates a new one if it doesn't.
 * The generated token is a random string of 32 hexadecimal characters.
 *
 * @return string The generated CSRF token.
 */
    public static function generateToken(): string
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }
    /**
     * Validates a CSRF token.
     *
     * This function checks if a session has been started and starts one if it hasn't.
     * It then checks if a CSRF token exists in the session and compares it with the provided token.
     * If the tokens match, the function removes the token from the session and returns true.
     * If the tokens do not match or the session does not contain a CSRF token, the function returns false.
     *
     * @param string $token The CSRF token to validate.
     * @return bool Returns true if the token is valid, false otherwise.
     */
    public static function validateToken($token): bool
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {
            unset($_SESSION['csrf_token']); // Remove token after validation
            return true;
        }

        return false;
    }
}
