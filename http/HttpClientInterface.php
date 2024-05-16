<?php

namespace fenBeiTong\http;

use Psr\Http\Message\StreamInterface;

interface HttpClientInterface
{
    /**
     * @param string $uri
     * @param array $query
     * @return array
     */
    public function get(string $uri, array $query = []): array;

    /**
     * @param string $uri
     * @param array $query
     * @return StreamInterface
     */
    public function getStream(string $uri, array $query = []): StreamInterface;


    /**
     * @param string $uri
     * @param array $query
     * @return array
     */
    public function post(string $uri,array $query=[]):array;

    /**
     * @param string $uri
     * @param array $json
     * @param array $query
     * @return array
     */
    public function postJson(string $uri, array $json = [], array $query = []): array;
    /**
     * @param string $uri
     * @param array $header
     * @param array $query
     * @return array
     */
    public function postHeader(string $uri, array $header = [], array $query = []): array;

    /**
     * @param string $uri
     * @param array $multiParts
     * @param array $query
     * @return array
     */
    public function postFile(string $uri, array $multiParts, array $query = []): array;
}
