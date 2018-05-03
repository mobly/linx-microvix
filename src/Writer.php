<?php

namespace Mobly\LinxMicrovix;

use Mobly\LinxMicrovix\Writer\Configuration;
use Mobly\LinxMicrovix\Writer\Entities\Import;
use Mobly\LinxMicrovix\Writer\Entities\ImportResponse;
use Mobly\LinxMicrovix\Writer\Factories\RequestFactory;
use Mobly\LinxMicrovix\Writer\Services\Importer;

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

        $options = ["connection_timeout" => 15];
        $this->importer = new Importer($configuration->getWsdlUrl(), $options);
    }

    /**
     * @param array $data
     * @return ImportResponse
     */
    public function send(array $data)
    {
        $request = $this->requestFactory->build($this->getTable(), $data);
        $importRequest = new Import($request);

        return $this->importer->import($importRequest);
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