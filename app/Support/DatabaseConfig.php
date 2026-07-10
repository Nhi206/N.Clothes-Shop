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

    public static function resolveMysqlOptions(array $env = []): array
    {
        $options = [];

        $sslCaPath = self::resolveSslCaPath((string) ($env['MYSQL_ATTR_SSL_CA'] ?? env('MYSQL_ATTR_SSL_CA', '')));
        if ($sslCaPath !== '') {
            $options[\PDO::MYSQL_ATTR_SSL_CA] = $sslCaPath;
        }

        $sslMode = (string) ($env['DB_SSLMODE'] ?? env('DB_SSLMODE', ''));
        if ($sslMode !== '') {
            $options[\PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = $sslMode !== 'disable';
        }

        return array_filter($options, static fn ($value) => $value !== null);
    }
}
