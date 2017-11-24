<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 24/11/2017
 * Time: 11:48 AM
 */

namespace Wx\Access\Token;


class Client
{
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var StorageHandlerInterface
     */
    private $storage;

    /**
     * @var string
     */
    private $keyName = 'wx-access-token';

    /**
     * Client constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param StorageHandlerInterface $storageHandler
     */
    public function setStorageHandler(StorageHandlerInterface $storageHandler) {
        $this->storage = $storageHandler;
    }

    /**
     * @return FileStorageHandler|StorageHandlerInterface
     */
    public function getStorage() {
        if (!$this->storage) {
            $this->storage = new FileStorageHandler();
        }
        return $this->storage;
    }

    /**
     * @return bool|string
     */
    public function fetch() {
        return file_get_contents(
            'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.
            $this->configuration->appID.
            '&secret='.$this->configuration->appSecret
        );
    }

    /**
     * @return null|Token
     */
    public function fetchAndSave() {
        $content = $this->fetch();
        if ($content) {
            $token = new Token();
            $this->setToken($token, json_decode($content, true));
            $this->save($token);
        }
        return $this->get();
    }

    /**
     * @return Token|null
     */
    public function get() {
        return unserialize($this->getStorage()->get($this->keyName));
    }

    /**
     * @param Token $token
     * @return null|Token
     */
    public function save(Token $token) {
        $this->getStorage()->save($this->keyName, serialize($token));
        return $this->get();
    }

    public function isExpired() {
        if ($updateTime = $this->getStorage()->getUpdateTime($this->keyName)) {
            var_dump($updateTime);
            return (time() - $updateTime) > $this->configuration->expiresSeconds;
        }

        return true;
    }

    /**
     * @param Token $token
     * @param $content
     */
    protected function setToken(Token $token, $content) {
        foreach($token as $key => $value) {
            if (isset($content[$key])) {
                $token->{$key} = $content[$key];
            }
        }
    }
}