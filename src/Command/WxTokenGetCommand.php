<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 24/11/2017
 * Time: 3:02 PM
 */

namespace Wx\Access\Token\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Wx\Access\Token\Client;

class WxTokenGetCommand extends Command
{
    public function configure()
    {
        $this->setName('wx:token:get')
            ->setDescription('Get token from cache file.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Client $client */
        $client = $this->getHelper('WxTokenClient')->getClient();
        $output->writeln(json_encode((array)$client->get(), JSON_PRETTY_PRINT));
    }
}