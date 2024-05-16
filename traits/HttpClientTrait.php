<?php
    namespace fenBeiTong\traits;

    use fenBeiTong\http\HttpClientInterface;

    trait HttpClientTrait
    {
    protected $httpClient;
        public function setHttpClient(HttpClientInterface $httpClient): void
        {
            $this->httpClient = $httpClient;
        }
}