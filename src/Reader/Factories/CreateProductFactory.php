<?php

namespace Mobly\LinxMicrovix\Reader\Factories;

/**
 * Class CreateProductFactory
 * @package Mobly\LinxMicrovix\Reader\Factories
 */
class CreateProductFactory extends AbstractRequestFactory
{

    /**
     * @var array 
     */
    protected $searchFields = [
        'codigo_produto' => 'NULL',
    ];
    
}