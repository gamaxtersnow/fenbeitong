<?php

namespace fenBeiTong\apiCache;

use fenBeiTong\traits\CacheTrait;
use Psr\SimpleCache\InvalidArgumentException;

abstract class AbstractApiCache
{
    use CacheTrait;
    abstract protected function getCacheKey(): string;
    abstract protected function getTokenFromServer():string;
    abstract public function getSign():string;

    /**
     * @param bool $refresh
     * @return string
     * @throws InvalidArgumentException
     */
    public function get(bool $refresh = false):string
    {
        $key = $this->getCacheKey();
        $token = $this->cache->get($key);
        if($refresh || empty($token)) {
            $token = $this->getTokenFromServer();
            $this->cache->set($key, json_encode($token), 7100);

        }
        return $token;
    }
}
