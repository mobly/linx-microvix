<?php

namespace Mobly\LinxMicrovix\Writer\Entities;

use Mobly\LinxMicrovix\Writer\Entities\Table\Record;

/**
 * Class Table
 * @package Mobly\LinxMicrovix\Writer\Entities
 */
class Table
{

    /**
     * @var string $Comando
     * @access public
     */
    protected $Comando = null;

    /**
     * @var Record[] $Registros
     * @access public
     */
    protected $Registros = null;

    /**
     * @return string
     */
    public function getCommand()
    {
        return $this->Comando;
    }

    /**
     * @param string $command
     * @return Table
     */
    public function setCommand($command)
    {
        $this->Comando = $command;
        return $this;
    }

    /**
     * @return Record[]
     */
    public function getData()
    {
        return $this->Registros;
    }

    /**
     * @param Record[] $records
     * @return Table
     */
    public function setData($records)
    {
        $this->Registros = $records;
        return $this;
    }

}
