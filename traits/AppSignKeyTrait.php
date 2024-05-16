<?php

namespace fenBeiTong\traits;

trait AppSignKeyTrait
{
    /**
     * @var string
     */
    protected $appSign;
    public function setSignKey(string $appSign): void
    {
        $this->appSign = $appSign;
    }
}

