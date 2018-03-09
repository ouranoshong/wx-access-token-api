<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 24/11/2017
 * Time: 12:00 PM
 */

namespace Wx\Access\Token;


/**
 * Class FileStorageHandler
 * @package Wx\Access\Token
 */
class FileStorageHandler implements StorageHandlerInterface
{

    private $savePath = '';

    public function generateFileName($key) {
        if (!$this->savePath) {
            $this->savePath = sys_get_temp_dir();
        }

        return $this->savePath . '/'. $key;
    }

    public function save($key, $value)
    {
        return file_put_contents($this->generateFileName($key), $value);
    }

    public function get($key)
    {
        return file_get_contents($this->generateFileName($key));
    }

    public function getUpdateTime($key) {
        return @filemtime($this->generateFileName($key));
    }

    public function setSavePath($path) {
        $this->savePath = $path;
    }
}