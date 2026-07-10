<?php

namespace Tests\Unit;

use App\Support\DatabaseConfig;
use PHPUnit\Framework\TestCase;

class DatabaseConfigTest extends TestCase
{
    public function test_relative_ssl_ca_path_is_resolved_against_the_project_root(): void
    {
        $expected = str_replace('\\', '/', dirname(__DIR__, 2).'/storage/certs/isrgrootx1.pem');

        $this->assertSame(
            $expected,
            DatabaseConfig::resolveSslCaPath('storage/certs/isrgrootx1.pem')
        );
    }

    public function test_absolute_ssl_ca_path_is_left_unchanged(): void
    {
        $path = '/tmp/ca.pem';

        $this->assertSame($path, DatabaseConfig::resolveSslCaPath($path));
    }

    public function test_mysql_ssl_options_can_be_resolved_from_environment_values(): void
    {
        $options = DatabaseConfig::resolveMysqlOptions([
            'MYSQL_ATTR_SSL_CA' => 'storage/certs/isrgrootx1.pem',
            'DB_SSLMODE' => 'require',
        ]);

        $this->assertSame(
            str_replace('\\', '/', dirname(__DIR__, 2).'/storage/certs/isrgrootx1.pem'),
            $options[\PDO::MYSQL_ATTR_SSL_CA]
        );
        $this->assertTrue($options[\PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT]);
    }
}
