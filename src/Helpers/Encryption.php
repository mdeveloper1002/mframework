<?php

namespace Mdeveloper1002\Mframework\Helpers;

class Encryption
{
    public static function encrypt(string $data): string
    {
        $key = $_ENV['SECRET_KEY'];
        $iv = $_ENV['IV'];
        return openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
    }

    public static function decrypt(string $data): string
    {
        $key = $_ENV['SECRET_KEY'];
        $iv = $_ENV['IV'];
        return openssl_decrypt($data, 'aes-256-cbc', $key, 0, $iv);
    }
}