<?php

namespace fenBeiTong\traits;

trait AppIdTrait
{
    /**
     * @var string
     */
    protected $appId;
    public function setAppId(string $appId): void
    {
        $this->appId = $appId;
    }
}
