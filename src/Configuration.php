<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 24/11/2017
 * Time: 11:48 AM
 */

namespace Wx\Access\Token;


class Configuration
{
    public $appID;

    public $appSecret;

    public $expiresSeconds = 7200;

    public function __construct(array $settings = [])
    {
        if (isset($settings['appID']) ) {
            $this->appID = $settings['appID'];
        }

        if (isset($settings['appSecret'])) {
            $this->appSecret = $settings['appSecret'];
        }
    }
}