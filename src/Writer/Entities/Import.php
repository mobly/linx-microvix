<?php

namespace Mobly\LinxMicrovix\Writer\Entities;

/**
 * Class Import
 * @package Mobly\LinxMicrovix\Writer\Entities
 */
class Import
{

    /**
     * @var Request $request
     * @access public
     */
    public $request = null;

    /**
     * @param Request $request
     * @access public
     */
    public function __construct($request)
    {
      $this->request = $request;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     * @return Import
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }
}
