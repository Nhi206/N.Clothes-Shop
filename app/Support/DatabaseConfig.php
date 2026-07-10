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

        $sslMode = (string) ($env['DB_SSLMODE'] ?? env('DB_SSLMODE', ''));
        if ($sslMode === 'require' || $sslMode === 'verify-ca' || $sslMode === 'verify-identity') {
            $options[\PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
        }

        return array_filter($options, static fn ($value) => $value !== null);
    }
}
