<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 24/11/2017
 * Time: 2:55 PM
 */

namespace Wx\Access\Token\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Wx\Access\Token\Client;

class WxTokenFetchAndSaveCommand extends Command
{
    public function configure()
    {
        $this->setName('wx:token:fetch-and-save')
            ->setDescription('Fetch then save token from wei xin service.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Client $client */
        $client = $this->getHelper('WxTokenClient')->getClient();

        $io = new SymfonyStyle($input, $output);

        if ($io->confirm('Are you sure')) {
            $token = $client->fetchAndSave();

            if ($token->access_token) {
                $io->success('fetch successfully : '.json_encode((array)$token, JSON_PRETTY_PRINT));
            } else {
                $io->error('fetch wrong data!');
            }
        }

    }
}