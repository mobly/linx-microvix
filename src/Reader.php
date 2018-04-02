<?php

namespace Mobly\LinxMicrovix;

use GuzzleHttp\Client;
use Mobly\LinxMicrovix\Reader\Configuration;
use Mobly\LinxMicrovix\Reader\Factories\RequestFactory;
use Mobly\LinxMicrovix\Reader\Response;

/**
 * Class Reader
 * @package Mobly\LinxMicrovix
 */
class Reader
{
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
     * @return Response
     * @throws \Exception
     */
    public function get($command)
    {
        $requestFactory = new RequestFactory($this->configuration);
        $xml = $requestFactory->build($command);

        try {
            $response = $this->client->request(
                'POST',
                $this->getConfiguration()->getUrl(),
                [
                    'headers' => [
                        'Content-Type' => 'text/xml',
                    ],
                    'body' => $xml
                ]
            );

            $result = $response->getBody()->getContents();

            return new Response($result);
        } catch (\Exception $e) {
            throw $e;
        }

    }

}