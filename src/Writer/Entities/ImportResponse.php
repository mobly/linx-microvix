<?php

namespace Mobly\LinxMicrovix\Writer\Entities;

use Mobly\LinxMicrovix\LastRequestInterface;
use Mobly\LinxMicrovix\Writer\Services\ImporterResponse;

/**
 * Class ImportResponse
 * @package Mobly\LinxMicrovix\Writer\Entities
 */
class ImportResponse implements LastRequestInterface
{

    /**
     * @var ImporterResponse $ImportarResult
     * @access public
     */
    protected $ImportarResult = null;

    /**
     * @var
     */
    protected $lastRequest;

    /**
     * @param ImporterResponse $ImportarResult
     * @access public
     */
    public function __construct($ImportarResult)
    {
      $this->ImportarResult = $ImportarResult;
    }

    /**
     * @return ImporterResponse
     */
    public function getImportarResult()
    {
        return $this->ImportarResult;
    }

    /**
     * @param ImporterResponse $ImportarResult
     * @return ImportResponse
     */
    public function setImportarResult($ImportarResult)
    {
        $this->ImportarResult = $ImportarResult;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastRequest()
    {
        return $this->lastRequest;
    }

    /**
     * @param mixed $lastRequest
     * @return ImportResponse
     */
    public function setLastRequest($lastRequest)
    {
        $this->lastRequest = $lastRequest;
        return $this;
    }
}
