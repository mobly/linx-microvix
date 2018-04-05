<?php

namespace Mobly\LinxMicrovix\Reader\Factories;

/**
 * Class SellerFactory
 * @package Mobly\LinxMicrovix\Reader\Factories
 */
class ProductDetailFactory extends AbstractRequestFactory
{
    /**
     * @var array
     */
    protected $searchFields = [
        'data_mov_fim' => 'NULL',
        'data_mov_ini' => 'NULL',
        'referencia' => 'NULL',
    ];

}