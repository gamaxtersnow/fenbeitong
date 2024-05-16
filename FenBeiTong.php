<?php

namespace fenBeiTong;

use Doctrine\Common\Collections\ArrayCollection;
use fenBeiTong\apiCache\Token;
use fenBeiTong\http\ClientFactory;
use fenBeiTong\http\HttpClient;
use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class FenBeiTong extends ContainerBuilder
{
    /**
     * @var ArrayCollection
     */
    private $config;

    /**
     * @var array
     */
    private $apiServices = [
//        'attachment'     => Api\Attachment::class,
//        'dataLink'       => Api\DataLink::class,
//        'departments'    => Api\Departments::class,
//        'dimensions'     => Api\Dimensions::class,
//        'feeTypes'       => Api\FeeTypes::class,
//        'flow'           => Api\Flow::class,
//        'pay'            => Api\Pay::class,
//        'specifications' => Api\Specifications::class,
//        'staffs'         => Api\Staffs::class
    ];

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct();

        $this->config = new ArrayCollection($config);
        $this->registerServices();
    }

    /**
     * @return void
     */
    private function registerServices(): void
    {
        $this->registerLogger();
        $this->registerHttpClient();
        $this->registerCache();
        $this->registerToken();
        $this->registerHttpClientWithToken();

        foreach ($this->apiServices as $id => $class) {
            $this->registerApi($id, $class);
        }
    }

    /**
     * @return void
     */
    private function registerLogger(): void
    {

        $this->register('logger', $this->config->get('log'));

    }

    /**
     * @return void
     */
    private function registerHttpClient(): void
    {
        $this->register('client', Client::class)
            ->setArguments([$this->config->get('base_url'),new Reference('logger')])
            ->setFactory([ClientFactory::class, 'create']);

        $this->register('http_client', HttpClient::class)
            ->addArgument(new Reference('client'));
    }

    /**
     * @return void
     */
    private function registerCache(): void
    {
        $this->register('cache', $this->config->get('cache'));
    }

    /**
     * @return void
     */
    private function registerToken(): void
    {
        $this->register('token', Token::class)
            ->addMethodCall('setAppId', [$this->config->get('app_id')])
            ->addMethodCall('setAppKey', [$this->config->get('app_key')])
            ->addMethodCall('setCache', [new Reference('cache')])
            ->addMethodCall('setHttpClient', [new Reference('http_client')]);
    }

    /**
     * @return void
     */
    private function registerHttpClientWithToken(): void
    {
        $this->register('client_with_token', Client::class)
            ->setArguments([$this->config->get('base_url'),new Reference('logger'), new Reference('token')])
            ->setFactory([ClientFactory::class, 'create']);

        $this->register('http_client_with_token', HttpClient::class)
            ->addArgument(new Reference('client_with_token'));
    }

    /**
     * @param string $id
     * @param string $class
     *
     * @return void
     */
    private function registerApi(string $id, string $class): void
    {
        $this->register($id, $class)->addMethodCall('setHttpClient', [new Reference('http_client_with_token')]);

    }
}


