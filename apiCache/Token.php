<?php

namespace fenBeiTong\apiCache;

use fenBeiTong\traits\AppIdTrait;
use fenBeiTong\traits\AppKeyTrait;
use fenBeiTong\traits\AppSignKeyTrait;
use fenBeiTong\traits\HttpClientTrait;

class Token extends AbstractApiCache
{
    use AppIdTrait,AppKeyTrait,AppSignKeyTrait,HttpClientTrait;

    protected function getCacheKey(): string
    {
        $unique = md5($this->appId.$this->appKey);

        return md5('ekb.api.token.' . $unique);
    }

    protected function getTokenFromServer(): string
    {
        $data = $this->httpClient->postJson('/openapi/auth/getToken', ['app_id' => $this->appId, 'app_key' => $this->appKey]);
        return $data['data']??'';
    }
    public function getSign(): string
    {
        return $this->appSign;
    }
}
