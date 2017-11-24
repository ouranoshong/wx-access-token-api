<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 24/11/2017
 * Time: 2:52 PM
 */

namespace Wx\Access\Token\Command;


use Symfony\Component\Console\Helper\Helper;
use Wx\Access\Token\Client;

class ClientHelper extends Helper
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getClient() {
        return $this->client;
    }

    public function getName()
    {
        return 'WxTokenClient';
    }

}