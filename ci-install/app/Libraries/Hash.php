<?php

namespace App\Libraries;

use RuntimeException;

class Hash
{
    /**
     * Hash a password using the Bcrypt algorithm.
     *
     * @param string $password The plain text password to hash
     * @param int $cost The number of iterations of the algorithm to use (default: 10)
     * @return string The hashed password
     */
    public static function make($password, $cost = 10)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => $cost]);

        if (!$hash) {
            throw new RuntimeException('Bcrypt hashing not supported.');
        }

        return $hash;
    }

    /**
     * Check if a plain text password matches a Bcrypt hash.
     *
     * @param string $password The plain text password to check
     * @param string $hash The Bcrypt hash to check against
     * @return bool True if the password matches the hash, false otherwise
     */
    public static function check($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
