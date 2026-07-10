<?php

namespace App\Support;

class DatabaseConfig
{
    public static function resolveSslCaPath(string $path): string
    {
        if ($path === '' || str_starts_with($path, '/') || preg_match('#^[A-Za-z]:[\\\\/]#', $path) === 1) {
            return $path;
        }

        return str_replace('\\', '/', dirname(__DIR__, 2).'/'.$path);
    }
}
