<?php

namespace Damianchojnacki\AccessToken;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Cookie;

class AccessToken
{
    public static function check(?string $token): bool
    {
        return $token == self::get();
    }

    public static function get(): ?string
    {
        return config('access.token');
    }

    public static function generate(): string
    {
        return Str::random(32);
    }

    public static function createCookie(): Cookie
    {
        return cookie('access-token', self::get(), config('access.expiration'));
    }
}
