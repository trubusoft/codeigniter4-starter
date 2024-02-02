<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations
     * and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to
     * use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * The default database connection.
     */
    public array $default = [
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => '',
        'password'     => '',
        'database'     => '',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8',
        'DBCollat'     => 'utf8_general_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
    ];

    /**
     * This database connection is used when
     * running PHPUnit database tests.
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => 'utf8_general_ci',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
    ];

    public function __construct()
    {
        parent::__construct();

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }

        // assign the default database configuration from environment variables (if given)
        if (getenv('DB_DEFAULT_HOSTNAME')){
            $this->default['hostname'] = getenv('DB_DEFAULT_HOSTNAME') ?? $this->default['hostname'];
            $this->default['username'] = getenv('DB_DEFAULT_USERNAME') ?? $this->default['username'];
            $this->default['password'] = getenv('DB_DEFAULT_PASSWORD') ?? $this->default['password'];
            $this->default['database'] = getenv('DB_DEFAULT_DATABASE') ?? $this->default['database'];
            $this->default['DBDriver'] = getenv('DB_DEFAULT_DBDRIVER') ?? $this->default['DBDriver'];
            $this->default['port'] = getenv('DB_DEFAULT_PORT') ?? $this->default['port'];
        }

        // assign the test database configuration from environment variables (if given)
        if (getenv('DB_TESTS_HOSTNAME')){
            $this->tests['hostname'] = getenv('DB_TESTS_HOSTNAME') ?? $this->tests['hostname'];
            $this->tests['username'] = getenv('DB_TESTS_USERNAME') ?? $this->tests['username'];
            $this->tests['password'] = getenv('DB_TESTS_PASSWORD') ?? $this->tests['password'];
            $this->tests['database'] = getenv('DB_TESTS_DATABASE') ?? $this->tests['database'];
            $this->tests['DBDriver'] = getenv('DB_TESTS_DBDRIVER') ?? $this->tests['DBDriver'];
            $this->tests['port'] = getenv('DB_TESTS_PORT') ?? $this->tests['port'];
        }
    }
}
