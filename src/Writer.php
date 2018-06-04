<?php

namespace Mobly\LinxMicrovix;

use Mobly\LinxMicrovix\Writer\Configuration;
use Mobly\LinxMicrovix\Writer\Entities\Import;
use Mobly\LinxMicrovix\Writer\Entities\ImportResponse;
use Mobly\LinxMicrovix\Writer\Factories\RequestFactory;
use Mobly\LinxMicrovix\Writer\Services\Importer;
use Mobly\LinxMicrovix\Writer\Services\ImporterResponse;

/**
 * Class Writer
 * @package Mobly\LinxMicrovix
 */
class Writer
{
    /**
     * @var Configuration
     */
    protected $configuration;

    /**
     * @var string
     */
    protected $table;

    /**
     * @var RequestFactory
     */
    protected $requestFactory;

    /**
     * @var Importer
     */
    protected $importer;

    /**
     * Writer constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
        $this->requestFactory = new RequestFactory($configuration);

        $options = ["connection_timeout" => 15, 'trace' => 1];

        $this->importer = new Importer($configuration->getWsdlUrl(), $options);
    }

    /**
     * @param array $data
     * @return ImportResponse
     */
    public function send(array $data)
    {
        try {
            $request = $this->requestFactory->build($this->getTable(), $data);
            $importRequest = new Import($request);

            $response = $this->importer->import($importRequest);

            if ($response instanceof LastRequestInterface) {
                $response->setLastRequest($this->importer->__getLastRequest());
            }

        } catch (\SoapFault $e) {
            $response = new ImporterResponse(false);
            $response->setLastRequest($this->importer->__getLastRequest());
            $response->setMensagem($e->getMessage());
        }

        return $response;
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
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     * @return Writer
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }
}