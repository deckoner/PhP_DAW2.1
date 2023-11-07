<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Encryption configuration.
 *
 * These are the settings used for encryption, if you don't pass a parameter
 * array to the encrypter for creation/initialization.
 */
class Encryption extends BaseConfig
{
    public $key = 'DigimonchosTCGProyecto@increible';
    public $driver = 'OpenSSL';
}
