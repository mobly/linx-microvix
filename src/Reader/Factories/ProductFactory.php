<?php

namespace Mobly\LinxMicrovix\Reader\Factories;

/**
 * Class ProductFactory
 * @package Mobly\LinxMicrovix\Reader\Factories
 */
class ProductFactory extends AbstractRequestFactory
{
    /**
     * @var array
     */
    protected $searchFields = [
        'id_setor' => 'NULL',
        'id_linha' => 'NULL',
        'id_marca' => 'NULL',
        'id_colecao' => 'NULL',
        'dt_update_inicio' => 'NULL',
        'dt_update_fim' => 'NULL',
        'cod_produto' => 'NULL',
        'referencia' => 'NULL',
    ];
}
