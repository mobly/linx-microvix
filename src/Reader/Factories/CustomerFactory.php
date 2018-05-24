<?php

namespace Mobly\LinxMicrovix\Reader\Factories;

/**
 * Class CustomerFactory
 * @package Mobly\LinxMicrovix\Reader\Factories
 */
class CustomerFactory extends AbstractRequestFactory
{
    /**
     * @var array
     */
    protected $searchFields = [
        'doc_cliente' => 'NULL',
        'data_inicial' => 'NULL',
        'data_fim' => 'NULL',
    ];
}
