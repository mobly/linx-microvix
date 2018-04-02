<?php

namespace Mobly\LinxMicrovix\Writer\Entities;

/**
 * Class CommandParameter
 * @package Mobly\LinxMicrovix\Writer\Entities
 */
class CommandParameter
{

    /**
     * @var string $Name
     * @access public
     */
    protected $Name = null;

    /**
     * @var string $Value
     * @access public
     */
    protected $Value = null;

    /**
     * @access public
     */
    public function __construct()
    {
    
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param string $Name
     * @return CommandParameter
     */
    public function setName($Name)
    {
        $this->Name = $Name;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->Value;
    }

    /**
     * @param string $Value
     * @return CommandParameter
     */
    public function setValue($Value)
    {
        $this->Value = $Value;
        return $this;
    }

}
