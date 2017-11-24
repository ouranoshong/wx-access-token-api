<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 24/11/2017
 * Time: 11:52 AM
 */

namespace Wx\Access\Token;


/**
 * Interface StorageHandlerInterface
 * @package Wx\Access\Token
 */
interface StorageHandlerInterface
{
    /**
     * define method that how to save token
     * @param $key
     * @param $value
     * @return mixed
     */
    public function save($key, $value);

    /**
     * define  method that how to get token
     * @param $key
     * @return mixed
     */
    public function get($key);
}