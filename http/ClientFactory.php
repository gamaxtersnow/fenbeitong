<?php

namespace fenBeiTong\http;

use app\common\utils\http\HttpMiddleware;
use fenBeiTong\apiCache\Token;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

trait ClientFactory
{
    protected $httpClient;
    public static function create(string $baseUrl,LoggerInterface $logger, $token = null): ClientInterface
    {
        $stack = HandlerStack::create();
        $stack->push(HttpMiddleware::retry($logger));
        $stack->push(FBTMiddleware::response());
        $stack->push(HttpMiddleware::log($logger));
        if($token instanceof Token) {
            $stack->push(FBTMiddleware::auth($token));
        }
        return new Client(['base_uri' => $baseUrl,'handler' => $stack]);
    }
}
