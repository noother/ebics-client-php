<?php

namespace AndrewSvirin\Ebics\Services;

use DateTime;

/**
 * Random function.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Andrew Svirin
 *
 * @internal
 */
class RandomService
{

    /**
     * Generate random bytes in hex presentation in upper register.
     *
     * @param int $length Bytes amount
     *
     * @return string
     */
    public function hexBytes(int $length): string
    {
        $randomBytes = $this->bytes($length);
        $randomHexBytes = bin2hex($randomBytes);

        return $randomHexBytes;
    }

    /**
     * Generate random digits.
     *
     * @param int $length
     *
     * @return string
     */
    public function digits(int $length): string
    {
        $characters = '0123456789';
        $randomDigits = $this->random($characters, $length);

        return $randomDigits;
    }

    /**
     * Generate random bytes.
     *
     * @param int $length
     *
     * @return string
     */
    public function bytes(int $length): string
    {
        return random_bytes($length);
    }

    /**
     * Generate random characters where first character not 0.
     *
     * @param string $characters
     * @param int $length
     *
     * @return string
     */
    private function random(string $characters, int $length)
    {
        $charactersLength = strlen($characters);

        $random = '';

        // Avoid set 0 as first character.
        $random .= $characters[rand(1, $charactersLength - 1)];

        // Generate other characters randomly.
        for ($i = 1; $i < $length; $i++) {
            $random .= $characters[rand(0, $charactersLength - 1)];
        }

        return $random;
    }

    /**
     * Generate unique id with current date time prefix.
     *
     * @param string|null $prefix
     *
     * @return string
     */
    public function uniqueIdWithDate(string $prefix = null): string
    {
        $now = new DateTime();

        $uniqid = $prefix . uniqid($now->format('YmdHisv'));
        return substr($uniqid, 0, 35);
    }
}
