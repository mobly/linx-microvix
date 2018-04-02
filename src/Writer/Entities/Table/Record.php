<?php

namespace Mobly\LinxMicrovix\Writer\Entities\Table;

use Mobly\LinxMicrovix\Writer\Entities\CommandParameter;

/**
 * Class Record
 * @package Mobly\LinxMicrovix\Writer\Entities
 */
class Record
{

    /**
     * @var CommandParameter[] $Colunas
     * @access public
     */
    protected $Colunas = null;

    /**
     * @return CommandParameter[]
     */
    public function getColumns()
    {
        return $this->Colunas;
    }

    /**
     * @param CommandParameter[] $Colunas
     * @return Record
     */
    public function setColumn($Colunas)
    {
        $this->Colunas = $Colunas;
        return $this;
    }

}
