<?php

    namespace fenBeiTong\http;
    use GuzzleHttp\Client;
    use GuzzleHttp\RequestOptions;
    use Psr\Http\Message\ResponseInterface;
    use Psr\Http\Message\StreamInterface;

    class HttpClient implements HttpClientInterface
    {
        private $client;

        /**
         * @param Client $client
         */
        public function __construct(Client $client)
        {
            $this->client = $client;
        }

        /**
         * @param string $uri
         * @param array $query
         * @return array
         */
        public function get(string $uri, array $query = []): array
        {
            return $this->_toArray($this->client->get($uri, compact('query')));
        }

        /**
         * @param string $uri
         * @param array $query
         * @return StreamInterface
         */
        public function getStream(string $uri, array $query = []): StreamInterface
        {
            return $this->client->get($uri, compact('query'))->getBody();
        }

        /**
         * @param string $uri
         * @param array $json
         * @param array $query
         * @return array
         */
        public function postJson(string $uri, array $json = [], array $query = []): array
        {
            return $this->_toArray($this->client->post($uri, compact('json', 'query')));
        }
        public function post(string $uri,array $query=[]):array {
            return $this->_toArray($this->client->post($uri,compact('query')));
        }

        /**
         * @param string $uri
         * @param array $header
         * @param array $query
         * @return array
         */
        public function postHeader(string $uri, array $header=[], array $query=[]):array {
            return $this->_toArray($this->client->post($uri,[
                RequestOptions::HEADERS=>$header,
                RequestOptions::QUERY =>compact('query')
            ]));
        }

        /**
         * @param string $uri
         * @param array $multiParts
         * @param array $query
         * @return array
         */
        public function postFile(string $uri, array $multiParts, array $query = []): array
        {
            return $this->_toArray($this->client->post($uri, array_merge([
                'multipart' => $multiParts

            ], compact('query'))));
        }
        private function _toArray(ResponseInterface $stream): array
        {
            return \GuzzleHttp\json_decode((string)$stream->getBody(), true);
        }
}
