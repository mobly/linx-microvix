<?php

namespace Mobly\LinxMicrovix\Writer\Services;

/**
 * Class ImporterResponse
 * @package Mobly\LinxMicrovix\Writer\Services
 */
class ImporterResponse
{

    /**
     * @var string[] $Mensagem
     * @access public
     */
    protected $Mensagem = null;

    /**
     * @var boolean $Succeeded
     * @access public
     */
    protected $Succeeded = null;

    /**
     * @param boolean $Succeeded
     * @access public
     */
    public function __construct($Succeeded)
    {
      $this->Succeeded = $Succeeded;
    }

    /**
     * @return \string[]
     */
    public function getMensagem()
    {
        return $this->Mensagem;
    }

    /**
     * @param \string[] $Mensagem
     * @return ImporterResponse
     */
    public function setMensagem($Mensagem)
    {
        $this->Mensagem = $Mensagem;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isSucceeded()
    {
        return $this->Succeeded;
    }

    /**
     * @param boolean $Succeeded
     * @return ImporterResponse
     */
    public function setSucceeded($Succeeded)
    {
        $this->Succeeded = $Succeeded;
        return $this;
    }

}
