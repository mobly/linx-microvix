<?php

namespace Mobly\LinxMicrovix;

use GuzzleHttp\Client;
use Mobly\LinxMicrovix\Reader\Configuration;
use Mobly\LinxMicrovix\Reader\Factories\AbstractRequestFactory;
use Mobly\LinxMicrovix\Reader\Factories\RequestFactory;
use Mobly\LinxMicrovix\Reader\Response;

/**
 * Class Reader
 * @package Mobly\LinxMicrovix
 */
class Reader
{

    const REQUEST_MAPPING = [
        'LinxVendedores' => 'Mobly\LinxMicrovix\Reader\Factories\SellerFactory',
        'LinxProdutosDetalhes' => 'Mobly\LinxMicrovix\Reader\Factories\ProductDetailFactory',
        'LinxClientesFornec' => 'Mobly\LinxMicrovix\Reader\Factories\CustomerFactory',
        'LinxPedidosVenda' => 'Mobly\LinxMicrovix\Reader\Factories\GetOrdersFactory',
    ];

    /**
     * @var Configuration
     */
    protected $configuration;

    /**
     * @var Client
     */
    protected $client;

    /**
     * Writer constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
        $this->client = new Client();
    }

    /**
     * @return Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param Configuration $configuration
     * @return Writer
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
        return $this;
    }

    /**
     * @param $command
     * @param array $customFilters
     * @return Response
     * @throws \Exception
     */
    public function get($command, $customFilters = [])
    {
        if (!array_key_exists($command, self::REQUEST_MAPPING)) {
            throw new \Exception('Command not mapped');
        }

        $class = self::REQUEST_MAPPING[$command];

        /**
         * @var AbstractRequestFactory $requestFactory
         */
        $requestFactory = new $class($this->configuration);
        $xml = $requestFactory->build($command, $customFilters);

        try {
            $response = $this->client->request(
                'POST',
                $this->getConfiguration()->getUrl(),
                [
                    'connect_timeout' => 10,
                    'headers' => [
                        'Content-Type' => 'text/xml',
                    ],
                    'body' => $xml
                ]
            );

            $result = $response->getBody()->getContents();

            return new Response($result, $xml);
        } catch (\Exception $e) {
            throw $e;
        }
    }

}