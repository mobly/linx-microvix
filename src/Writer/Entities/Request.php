<?php

namespace Mobly\LinxMicrovix\Writer\Entities;

/**
 * Class Request
 * @package Mobly\LinxMicrovix\Writer\Entities
 */
class Request
{

    /**
     * @var CommandParameter[] $ParamsSeletorDestino
     * @access public
     */
    protected $ParamsSeletorDestino = null;

    /**
     * @var Table $Tabela
     * @access public
     */
    protected $Tabela = null;

    /**
     * @var UserAuthentication $UserAuth
     * @access public
     */
    protected $UserAuth = null;

    /**
     * Request constructor.
     * @param UserAuthentication $userAuthentication
     * @param $destinationSelectorParameters
     */
    public function __construct(UserAuthentication $userAuthentication, $destinationSelectorParameters)
    {
        $this->UserAuth = $userAuthentication;
        $this->ParamsSeletorDestino = $destinationSelectorParameters;
    }

    /**
     * @return CommandParameter[]
     */
    public function getDestinationSelectorParameters()
    {
        return $this->ParamsSeletorDestino;
    }

    /**
     * @param CommandParameter[] $destinationSelectorParameters
     * @return Request
     */
    public function setDestinationSelectorParameters($destinationSelectorParameters)
    {
        $this->ParamsSeletorDestino = $destinationSelectorParameters;
        return $this;
    }

    /**
     * @return Table
     */
    public function getTable()
    {
        return $this->Tabela;
    }

    /**
     * @param $table
     * @return $this
     */
    public function setTable($table)
    {
        $this->Tabela = $table;
        return $this;
    }

    /**
     * @return UserAuthentication
     */
    public function getAuthentication()
    {
        return $this->UserAuth;
    }

    /**
     * @param UserAuthentication $UserAuth
     * @return Request
     */
    public function setAuthentication($UserAuth)
    {
        $this->UserAuth = $UserAuth;
        return $this;
    }

}
